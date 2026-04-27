<?php

namespace App\Http\Controllers;

use App\Mail\NewPendingCommentMail;
use App\Models\Comment;
use App\Services\AdminAlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class CommentController extends Controller
{
    public function store(Request $request, AdminAlertService $adminAlerts)
    {
        if ($this->honeypotFilled($request)) {
            Log::warning('Comment submission rejected as spam', [
                'reason' => 'honeypot',
                'ip' => $request->ip(),
            ]);

            return back()->with('success', 'Your comment has been submitted for review.');
        }

        if ($this->submittedTooFast($request)) {
            Log::warning('Comment submission rejected as spam', [
                'reason' => 'form_timing',
                'ip' => $request->ip(),
            ]);

            return back()->with('success', 'Your comment has been submitted for review.');
        }

        $rateKey = 'comment-submit:'.$request->ip();
        if (RateLimiter::tooManyAttempts($rateKey, 5)) {
            return back()
                ->withErrors(['rate_limit' => 'Too many submissions. Please try again later.'])
                ->withInput();
        }

        $rules = [
            'page_type' => 'required|string|max:50',
            'page_slug' => 'required|string|max:255',
            'content' => 'required|string|min:3|max:3000',
        ];

        if (! auth()->check()) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'nullable|email|max:255';
        } else {
            $rules['name'] = 'nullable|string|max:255';
            $rules['email'] = 'nullable|email|max:255';
        }

        $validated = $request->validate($rules);

        $name = trim($validated['name'] ?? '') ?: null;
        $email = trim($validated['email'] ?? '') ?: null;
        $content = trim($validated['content']);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'name' => $name,
            'email' => $email,
            'page_type' => $validated['page_type'],
            'page_slug' => $validated['page_slug'],
            'content' => $content,
            'status' => 'pending',
        ]);

        RateLimiter::hit($rateKey, 3600);

        $urlCount = $this->countUrlsInText($content);
        if ($urlCount > 3) {
            Log::warning('Comment flagged: high URL count (saved as pending)', [
                'comment_id' => $comment->id,
                'url_count' => $urlCount,
                'ip' => $request->ip(),
            ]);
        }

        Log::info('New Comment Submitted', [
            'comment_id' => $comment->id,
            'name' => $name,
            'email' => $email,
            'page_type' => $validated['page_type'],
            'page_slug' => $validated['page_slug'],
            'user_id' => auth()->id(),
        ]);

        $stubPayload = [
            'comment_id' => $comment->id,
            'name' => $name,
            'email' => $email,
            'page_type' => $validated['page_type'],
            'page_slug' => $validated['page_slug'],
            'content' => $content,
        ];
        $adminAlerts->notifyNewComment($stubPayload);

        $recipient = AdminAlertService::mailRecipient();
        if ($recipient) {
            try {
                $moderationUrl = route('admin.comments.show', $comment, true);
                Mail::to($recipient)->send(new NewPendingCommentMail($comment, $moderationUrl));
            } catch (\Throwable $e) {
                Log::warning('Failed to send new comment admin mail', [
                    'message' => $e->getMessage(),
                    'comment_id' => $comment->id,
                ]);
            }
        }

        return back()->with('success', 'Your comment has been submitted for review.');
    }

    private function honeypotFilled(Request $request): bool
    {
        $v = $request->input('website');

        return $v !== null && trim((string) $v) !== '';
    }

    private function submittedTooFast(Request $request): bool
    {
        $started = (int) $request->input('form_started_at', 0);
        if ($started <= 0) {
            return true;
        }

        $elapsed = time() - $started;

        return $elapsed < 3;
    }

    private function countUrlsInText(string $text): int
    {
        if (preg_match_all('/\bhttps?:\/\/[^\s<>"\']+|\bwww\.[^\s<>"\']+/i', $text, $matches)) {
            return count($matches[0]);
        }

        return 0;
    }
}
