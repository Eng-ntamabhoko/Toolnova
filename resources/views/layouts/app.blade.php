<!DOCTYPE html>
<html lang="en" id="top">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'ToolNova - Free Online Tools')</title>

    <meta name="description" content="@yield('meta_description', 'ToolNova provides free online tools for productivity, calculations, formatting, documents and more.')">
    <meta name="robots" content="@yield('robots', 'index, follow')">

    {{-- Canonical URL --}}
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- Open Graph / Facebook / WhatsApp --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ToolNova">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'ToolNova - Free Online Tools')))">
    <meta property="og:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', 'ToolNova provides free online tools for productivity, calculations, formatting, documents and more.')))">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/toolnova-logo.png'))">

    {{-- Twitter / X --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', trim($__env->yieldContent('title', 'ToolNova - Free Online Tools')))">
    <meta name="twitter:description" content="@yield('twitter_description', trim($__env->yieldContent('meta_description', 'ToolNova provides free online tools for productivity, calculations, formatting, documents and more.')))">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/toolnova-logo.png'))">

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Icons --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/toolnova-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/toolnova-logo.png') }}">

    {{-- Schema.org --}}
    <script type="application/ld+json">
        @yield('schema', json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'ToolNova',
            'url' => url('/'),
            'description' => 'Free online tools for calculations, text, images, coding, documents and productivity.',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/tools') . '?q={search_term_string}',
                'query-input' => 'required name=search_term_string'
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT))
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

    <a href="#main-content" class="skip-to-content">Skip to main content</a>

    <div class="min-h-screen flex flex-col">
        @include('partials.header')

        <main id="main-content" class="flex-1 scroll-mt-24 outline-none" tabindex="-1">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    @include('partials.back-to-top')

</body>
</html>