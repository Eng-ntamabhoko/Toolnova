<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class MessagesController extends Controller
{
    public function index()
    {
        $query = ContactMessage::query();

        if (request('type') === 'whatsapp') {
            $query->whereNotNull('whatsapp');
        }

        if (request('type') === 'email') {
            $query->whereNotNull('email')->whereNull('whatsapp');
        }

        $messages = $query->latest()->paginate(20)->withQueryString();

        $stats = [
            'total' => ContactMessage::count(),
            'whatsapp' => ContactMessage::whereNotNull('whatsapp')->count(),
            'email' => ContactMessage::whereNotNull('email')->whereNull('whatsapp')->count(),
        ];

        $type = request('type');

        return view('admin.messages.index', compact('messages', 'stats', 'type'));
    }

    public function show(ContactMessage $message)
    {
        return view('admin.messages.show', compact('message'));
    }
}