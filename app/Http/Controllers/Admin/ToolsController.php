<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\ToolUsageLog;

class ToolsController extends Controller
{
    public function __invoke()
    {
        $totalTools = Tool::count();
        $activeTools = Tool::where('is_active', true)->count();
        $featuredTools = Tool::where('is_featured', true)->count();

        $topTools = ToolUsageLog::selectRaw('tool_slug, COUNT(*) as total')
            ->whereNotNull('tool_slug')
            ->groupBy('tool_slug')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $tools = Tool::paginate(20);

        return view('admin.tools', compact(
            'totalTools',
            'activeTools',
            'featuredTools',
            'topTools',
            'tools'
        ));
    }
}