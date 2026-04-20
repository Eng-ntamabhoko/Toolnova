<?php

namespace App\Http\Controllers;

use App\Mail\NewContactMessageMail;
use App\Models\ContactMessage;
use App\Services\AdminAlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request, AdminAlertService $adminAlerts)
    {
        if ($this->honeypotFilled($request)) {
            Log::warning('Contact submission rejected as spam', [
                'reason' => 'honeypot',
                'ip' => $request->ip(),
            ]);

            return back()->with('success', '✅ Message sent successfully! We\'ll get back to you shortly.');
        }

        if ($this->submittedTooFast($request)) {
            Log::warning('Contact submission rejected as spam', [
                'reason' => 'form_timing',
                'ip' => $request->ip(),
            ]);

            return back()->with('success', '✅ Message sent successfully! We\'ll get back to you shortly.');
        }

        $rateKey = 'contact-submit:'.$request->ip();
        if (RateLimiter::tooManyAttempts($rateKey, 5)) {
            return back()
                ->withErrors(['rate_limit' => 'Too many submissions. Please try again later.'])
                ->withInput();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contact_method' => 'required|in:email,whatsapp',
            'email' => 'required_if:contact_method,email|nullable|email|max:255',
            'whatsapp' => 'required_if:contact_method,whatsapp|nullable|string|max:25',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = null;
        $whatsapp = null;

        if ($request->contact_method === 'email') {
            $email = trim($request->email ?: '');
            $email = $email ?: null;
        } elseif ($request->contact_method === 'whatsapp') {
            $whatsapp = $this->cleanPhoneNumber($request->whatsapp);
        }

        $data = [
            'name' => trim($request->name),
            'email' => $email,
            'whatsapp' => $whatsapp,
            'phone' => null,
            'subject' => 'General Contact',
            'message' => trim($request->message),
        ];

        if (Schema::hasColumn('contact_messages', 'source_page')) {
            $data['source_page'] = $request->source_page;
        }

        if (Schema::hasColumn('contact_messages', 'source_tool')) {
            $data['source_tool'] = $request->source_tool;
        }

        $message = ContactMessage::create($data);

        RateLimiter::hit($rateKey, 3600);

        $mailPayload = [
            'name' => $data['name'],
            'email' => $email,
            'whatsapp' => $whatsapp,
            'message' => $data['message'],
            'source_page' => $data['source_page'] ?? $request->source_page,
            'source_tool' => $data['source_tool'] ?? $request->source_tool,
        ];

        $adminAlerts->notifyNewContact($mailPayload);

        $recipient = AdminAlertService::mailRecipient();
        if ($recipient) {
            try {
                Mail::to($recipient)->send(new NewContactMessageMail($mailPayload));
            } catch (\Throwable $e) {
                Log::warning('Failed to send new contact admin mail', [
                    'message' => $e->getMessage(),
                    'contact_message_id' => $message->id,
                ]);
            }
        }

        return back()->with('success', '✅ Message sent successfully! We\'ll get back to you shortly.');
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

        return (time() - $started) < 3;
    }

    private function cleanPhoneNumber($number)
    {
        if (empty($number)) {
            return null;
        }

        // Remove all non-numeric characters
        $cleaned = preg_replace('/\D/', '', $number);

        // If empty after cleaning, return null
        if (empty($cleaned)) {
            return null;
        }

        // If starts with 0 and appears to be local format (shorter number)
        // Convert 0 to 255 for Tanzania as fallback
        if (substr($cleaned, 0, 1) === '0' && strlen($cleaned) <= 12) {
            $cleaned = '255' . substr($cleaned, 1);
        }

        // If no country code prefix detected and not starting with country code digit
        // Assume it needs a country code (this shouldn't happen if user provides one)
        if (strlen($cleaned) <= 10) {
            // Too short, likely missing country code
            return null;
        }

        return $cleaned ?: null;
    }
}