@extends('layouts.admin')

@section('title', 'Site Updates')
@section('admin_subtitle', 'Manage latest updates and announcements displayed on the homepage')

@section('content')
<div class="space-y-8">
    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Updates</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($totalUpdates) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Published</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($publishedCount) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Featured on Home</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($featuredCount) }}</p>
        </div>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Site Updates</h2>
                <p class="mt-1 text-sm text-slate-500">Manage updates shown in the Latest Updates section.</p>
            </div>
            <a href="{{ route('admin.updates.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd"/>
                </svg>
                Add Update
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-slate-100 bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Title</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Published</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Featured</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Published At</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($updates as $update)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-900">{{ $update->title }}</div>
                                <div class="text-sm text-slate-500">{{ Str::limit($update->excerpt, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $update->update_type ?? 'General' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($update->is_published)
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($update->is_featured_on_home)
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                        Featured
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                                        Hidden
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $update->published_at ? $update->published_at->format('M j, Y') : 'Not set' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.updates.edit', $update) }}" class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.updates.destroy', $update) }}" onsubmit="return confirm('Are you sure you want to delete this update?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-sm font-medium text-red-700 hover:bg-red-100">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">
                                No updates found. <a href="{{ route('admin.updates.create') }}" class="text-slate-900 underline">Create your first update</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($updates->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $updates->links() }}
            </div>
        @endif
    </section>
</div>
@endsection