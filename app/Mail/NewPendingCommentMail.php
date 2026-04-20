<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewPendingCommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Comment $comment,
        public string $moderationUrl,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'ToolNova: New comment pending moderation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-pending-comment',
            with: [
                'comment' => $this->comment,
                'moderationUrl' => $this->moderationUrl,
            ],
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
