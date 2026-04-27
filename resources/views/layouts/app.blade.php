<!DOCTYPE html>
<html lang="en" id="top">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ToolNova - Free Online Tools')</title>
    <meta name="description" content="@yield('meta_description', 'ToolNova provides free online tools for productivity, calculations, formatting and more.')">    <meta name="csrf-token" content="{{ csrf_token() }}">    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/toolnova-logo.png') }}">

<link rel="apple-touch-icon" href="{{ asset('images/toolnova-logo.png') }}">
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