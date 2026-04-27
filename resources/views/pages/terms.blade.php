@extends('layouts.app')

@section('title', 'Terms of Service - ToolNova')

@section('meta_description', 'Read ToolNova\'s Terms of Service to understand the rules, responsibilities, and conditions for using our online tools and platform.')

@section('content')
{{-- This page is structured to later move into CMS/static page management. --}}

<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div class="mx-auto max-w-2xl py-24 sm:py-32 lg:py-40">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                    Terms of Service
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    By using ToolNova, you agree to these terms. Please read them carefully to understand the rules, responsibilities, and conditions that govern your use of our platform and its tools.
                </p>
                <p class="mt-4 text-sm text-gray-500">
                    Last updated: {{ now()->format('F d, Y') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Use of the Platform -->
    <div class="py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Usage Guidelines</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Use of the Platform
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    ToolNova is provided for lawful purposes only. You agree to use the platform responsibly and ethically. You may not misuse our tools or attempt to disrupt the platform. Abuse, spam, automated scraping, malicious automation, or any harmful activity is strictly prohibited. We reserve the right to restrict access to users who violate these terms.
                </p>
            </div>
        </div>
    </div>

    <!-- Tool Availability and Accuracy -->
    <div class="py-16 sm:py-20 bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Service Delivery</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Tool Availability and Accuracy
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Our tools are provided for general-purpose use. While we work continuously to keep them accurate and reliable, we cannot guarantee that all outputs are completely error-free or suitable for every professional, legal, or financial use. You are responsible for reviewing the outputs of our tools before relying on them for important decisions. Always verify critical results independently when needed.
                </p>
            </div>
        </div>
    </div>

    <!-- Accounts and User Submissions -->
    <div class="py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">User Content</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Accounts and User Submissions
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Some tools or features may require or offer account creation now or in the future. You are responsible for the information you submit through our platform. Comments and messages may be moderated before appearing publicly. Please do not submit harmful, illegal, or sensitive personal information in public comments, as these may be visible to other users. We reserve the right to remove content that violates these terms.
                </p>
            </div>
        </div>
    </div>

    <!-- Intellectual Property -->
    <div class="py-16 sm:py-20 bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Ownership</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Intellectual Property
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    ToolNova's platform design, branding, and original content belong to ToolNova. You may use the tools normally through the website for lawful personal or professional purposes. You may not copy, resell, redistribute, or abuse the platform in unauthorized ways. Reverse engineering, scraping, or attempting to circumvent access controls is prohibited.
                </p>
            </div>
        </div>
    </div>

    <!-- Third-Party Services -->
    <div class="py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">External Partners</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Third-Party Services
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    ToolNova may rely on third-party services for hosting, email delivery, analytics, and infrastructure. The availability and quality of our platform partly depend on these external services. As our platform grows, we may integrate additional third-party services. We are not responsible for disruptions caused by third-party services beyond our control.
                </p>
            </div>
        </div>
    </div>

    <!-- Limitation of Liability -->
    <div class="py-16 sm:py-20 bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Disclaimer</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Limitation of Liability
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    ToolNova is provided as-is and as-available without warranties of any kind. We are not liable for losses resulting from misuse of tools, service downtime, data loss, or reliance on tool outputs where independent verification is needed. Where allowed by law, we limit our liability for any damages. We encourage you to use our tools responsibly and verify important outputs independently.
                </p>
            </div>
        </div>
    </div>

    <!-- Changes to the Service -->
    <div class="py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Evolution</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Changes to the Service
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    ToolNova is a growing platform, and we may update, improve, remove, or add tools and features over time. We may also modify the design and functionality of our platform as we continue to develop. We will make reasonable efforts to notify users of major changes, but continued use of the platform implies acceptance of such changes.
                </p>
            </div>
        </div>
    </div>

    <!-- Updates to These Terms -->
    <div class="py-16 sm:py-20 bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Policy Updates</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Updates to These Terms
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    We may update these Terms of Service from time to time to reflect changes in our platform, legal requirements, or business practices. We will make reasonable efforts to notify you of significant changes. Your continued use of ToolNova following any updates means you accept and agree to the updated terms.
                </p>
            </div>
        </div>
    </div>

    <!-- Contact Us -->
    <div class="py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Get in Touch</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Questions About These Terms?
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    If you have any questions, concerns, or feedback about these Terms of Service, of have any additional questions about our platform and practices, please contact us.
                </p>
                <div class="mt-8">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700">
                        Contact ToolNova
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
