<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New comment pending moderation</title>
</head>
<body style="font-family: ui-sans-serif, system-ui, sans-serif; line-height: 1.5; color: #1e293b;">
    <h1 style="font-size: 1.25rem;">New comment pending moderation</h1>
    <p><strong>Name:</strong> {{ $comment->name ?? '—' }}</p>
    <p><strong>Email:</strong> {{ $comment->email ?? '—' }}</p>
    <p><strong>Page type:</strong> {{ $comment->page_type }}</p>
    <p><strong>Page slug:</strong> {{ $comment->page_slug }}</p>
    <p><strong>Content</strong></p>
    <p style="white-space: pre-wrap;">{{ $comment->content }}</p>
    <p style="margin-top: 1.5rem;">
        <a href="{{ $moderationUrl }}" style="display: inline-block; padding: 0.5rem 1rem; background: #4f46e5; color: #fff; text-decoration: none; border-radius: 0.5rem;">Review in admin</a>
    </p>
    <p style="margin-top: 2rem; font-size: 0.875rem; color: #64748b;">{{ config('app.name') }}</p>
</body>
</html>
