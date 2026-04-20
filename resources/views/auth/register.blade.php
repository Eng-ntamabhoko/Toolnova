@extends('layouts.app')

@section('title', 'Register - ToolNova')

@section('content')
<div class="mx-auto mt-12 max-w-md rounded-2xl bg-white p-8 shadow">
    <h1 class="mb-6 text-2xl font-bold">Register</h1>

    @if($errors->any())
        <div class="mb-4 rounded bg-red-50 p-3 text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="mb-1 block text-sm font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded border px-3 py-2" />
        </div>

        <div class="mb-4">
            <label class="mb-1 block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded border px-3 py-2" />
        </div>

        <div class="mb-4">
            <label class="mb-1 block text-sm font-medium">Password</label>
            <input type="password" name="password" required class="w-full rounded border px-3 py-2" />
        </div>

        <div class="mb-6">
            <label class="mb-1 block text-sm font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation" required class="w-full rounded border px-3 py-2" />
        </div>

        <button type="submit" class="w-full rounded bg-green-600 py-2 text-white">Create account</button>
    </form>

    <p class="mt-4 text-sm">
        Already have an account? <a href="{{ route('login') }}" class="text-blue-600">Login</a>
    </p>
</div>
@endsection
