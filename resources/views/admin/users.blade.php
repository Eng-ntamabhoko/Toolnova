@extends('layouts.admin')

@section('title', 'Users - Admin')

@section('content')
<div class="space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-slate-900">Users</h1>
        <p class="text-slate-500">Manage users and monitor activity</p>
    </div>

    {{-- STATS --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @include('admin.partials.stat-card', ['label' => 'Total Users', 'value' => number_format($totalUsers)])
        @include('admin.partials.stat-card', ['label' => 'Active Users (7d)', 'value' => number_format($activeUsers)])
        @include('admin.partials.stat-card', ['label' => 'New Users (7d)', 'value' => number_format($newUsers)])
    </div>

    {{-- TOP USERS --}}
    <div class="bg-white p-6 rounded-3xl border shadow-sm">
        <h2 class="text-xl font-semibold mb-4">Top Active Users</h2>

        <div class="space-y-3 max-h-80 overflow-y-auto">
            @forelse($topUsers as $user)
                <div class="flex justify-between items-center bg-slate-50 px-4 py-2 rounded-xl">
                    <div>
                        <p class="font-medium">{{ $user->name }}</p>
                        <p class="text-xs text-slate-500">{{ $user->email }}</p>
                    </div>
                    <span class="text-sm font-semibold">{{ number_format($user->total) }}</span>
                </div>
            @empty
                <p class="text-sm text-slate-500">No activity yet.</p>
            @endforelse
        </div>
    </div>

    {{-- USERS TABLE --}}
    <div class="bg-white p-6 rounded-3xl border shadow-sm">
        <h2 class="text-xl font-semibold mb-4">All Users</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Role</th>
                        <th class="px-4 py-2 text-left">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-4 py-2 font-medium">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-600">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-slate-500">
                                {{ $user->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection