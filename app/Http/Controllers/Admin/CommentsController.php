<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');

        $query = Comment::with('user')->latest();

        if ($status && in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        $comments = $query->paginate(20);

        $stats = [
            'totalComments' => Comment::count(),
            'pendingComments' => Comment::where('status', 'pending')->count(),
            'approvedComments' => Comment::where('status', 'approved')->count(),
            'rejectedComments' => Comment::where('status', 'rejected')->count(),
        ];

        return view('admin.comments.index', compact('comments', 'stats', 'status'));
    }

    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    public function approve(Comment $comment)
    {
        $comment->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Comment approved successfully.');
    }

    public function reject(Comment $comment)
    {
        $comment->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Comment rejected successfully.');
    }

    public function updateNotes(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'admin_notes' => 'nullable|string|max:5000',
        ]);

        $comment->update([
            'admin_notes' => $validated['admin_notes'],
        ]);

        return back()->with('success', 'Admin notes updated successfully.');
    }
}
