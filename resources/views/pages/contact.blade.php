@extends('layouts.app')

@section('title', 'Contact Us - ToolNova')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Contact Us</h1>
            <p class="mt-2 text-gray-600">We'd love to hear from you. Send us a message.</p>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                ✅ Message sent successfully! We’ll get back to you shortly.
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6" x-data="{ contactMethod: '{{ old('contact_method', 'email') }}' }">
            @csrf

            <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" value="">
            <input type="hidden" name="form_started_at" value="{{ now()->timestamp }}">

            <input type="hidden" name="source_page" value="{{ url()->current() }}">
            <input type="hidden" name="source_tool" value="{{ request()->segment(2) }}">

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Preferred contact method</label>
                <p class="text-xs text-gray-500 mt-1">Choose how you want us to contact you back.</p>
                <div class="mt-3 grid grid-cols-2 gap-3">
                    <label class="inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-3 text-sm font-medium text-slate-700 cursor-pointer">
                        <input type="radio" name="contact_method" value="email" x-model="contactMethod" class="mr-2 h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        Email
                    </label>
                    <label class="inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-3 text-sm font-medium text-slate-700 cursor-pointer">
                        <input type="radio" name="contact_method" value="whatsapp" x-model="contactMethod" class="mr-2 h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                        WhatsApp
                    </label>
                </div>
            </div>

            <div x-show="contactMethod === 'email'" x-cloak style="display:none;">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div x-show="contactMethod === 'whatsapp'" x-cloak style="display:none;">
                <label for="whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp Number</label>
                <input type="tel" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}"
                       placeholder="+1 234 567 8900 or +255 712 345 678"
                       class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                <p class="mt-1 text-sm text-gray-500">Include country code (e.g., +1, +44, +255). Tip: WhatsApp usually gets a faster response.</p>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" required
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('message') }}</textarea>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Send Message
                </button>
            </div>
        </form>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection