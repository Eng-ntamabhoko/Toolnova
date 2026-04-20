<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New contact message</title>
</head>
<body style="font-family: ui-sans-serif, system-ui, sans-serif; line-height: 1.5; color: #1e293b;">
    <h1 style="font-size: 1.25rem;">New contact message</h1>
    <p><strong>Name:</strong> {{ $p['name'] }}</p>
    <p><strong>Email:</strong> {{ $p['email'] ?? '—' }}</p>
    <p><strong>WhatsApp:</strong> {{ $p['whatsapp'] ?? '—' }}</p>
    <p><strong>Message</strong></p>
    <p style="white-space: pre-wrap;">{{ $p['message'] }}</p>
    @if(!empty($p['source_page']))
        <p><strong>Source page:</strong> {{ $p['source_page'] }}</p>
    @endif
    @if(!empty($p['source_tool']))
        <p><strong>Source tool:</strong> {{ $p['source_tool'] }}</p>
    @endif
    <p style="margin-top: 2rem; font-size: 0.875rem; color: #64748b;">{{ config('app.name') }}</p>
</body>
</html>
