<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdatesController extends Controller
{
    public function index()
    {
        $updates = SiteUpdate::orderBy('sort_order')
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $totalUpdates = SiteUpdate::count();
        $publishedCount = SiteUpdate::where('is_published', true)->count();
        $featuredCount = SiteUpdate::where('is_featured_on_home', true)->count();

        return view('admin.updates.index', compact('updates', 'totalUpdates', 'publishedCount', 'featuredCount'));
    }

    public function create()
    {
        return view('admin.updates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:site_updates,slug',
            'excerpt' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'update_type' => 'nullable|string|max:100',
            'link' => 'nullable|url|max:1000',
            'is_published' => 'nullable|boolean',
            'is_featured_on_home' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'published_at' => 'nullable|date',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        SiteUpdate::create($validated);

        return redirect()->route('admin.updates.index')->with('success', 'Update created successfully.');
    }

    public function edit(SiteUpdate $update)
    {
        return view('admin.updates.edit', compact('update'));
    }

    public function update(Request $request, SiteUpdate $update)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:site_updates,slug,' . $update->id,
            'excerpt' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'update_type' => 'nullable|string|max:100',
            'link' => 'nullable|url|max:1000',
            'is_published' => 'nullable|boolean',
            'is_featured_on_home' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'published_at' => 'nullable|date',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $update->update($validated);

        return redirect()->route('admin.updates.index')->with('success', 'Update updated successfully.');
    }

    public function destroy(SiteUpdate $update)
    {
        $update->delete();

        return redirect()->route('admin.updates.index')->with('success', 'Update deleted successfully.');
    }
}
