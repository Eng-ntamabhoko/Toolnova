@extends('layouts.app')

@section('title', 'Forgot Password - ToolNova')

@section('content')
<div class="mx-auto mt-12 max-w-md rounded-2xl bg-white p-8 shadow">
    <h1 class="mb-6 text-2xl font-bold">Forgot Password</h1>

    @if(session('status'))
        <div class="mb-4 rounded bg-green-50 p-3 text-green-700">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label class="mb-1 block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded border px-3 py-2" />
        </div>

        <button type="submit" class="w-full rounded bg-blue-600 py-2 text-white">Send reset link</button>
    </form>

    <p class="mt-4 text-sm">
        Back to <a href="{{ route('login') }}" class="text-blue-600">login</a>
    </p>
</div>
@endsection
