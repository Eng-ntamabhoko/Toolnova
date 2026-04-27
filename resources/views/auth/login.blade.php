@extends('layouts.app')

@section('title', 'Login - ToolNova')

@section('content')
<div class="mx-auto mt-12 max-w-md rounded-2xl bg-white p-8 shadow">
    <h1 class="mb-6 text-2xl font-bold">Login</h1>

    @if($errors->any())
        <div class="mb-4 rounded bg-red-50 p-3 text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="mb-1 block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded border px-3 py-2" />
        </div>

        <div class="mb-4">
            <label class="mb-1 block text-sm font-medium">Password</label>
            <input type="password" name="password" required class="w-full rounded border px-3 py-2" />
        </div>

        <div class="mb-4 flex items-center justify-between">
            <label class="inline-flex items-center text-sm">
                <input type="checkbox" name="remember" class="mr-2" /> Remember me
            </label>
            <a href="{{ route('password.request') }}" class="text-sm text-blue-600">Forgot password?</a>
        </div>

        <button type="submit" class="w-full rounded bg-blue-600 py-2 text-white">Login</button>
    </form>

    <p class="mt-4 text-sm">
        Don't have an account? <a href="{{ route('register') }}" class="text-blue-600">Register</a>
    </p>
</div>
@endsection
