<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\ToolUsageLog;
use Illuminate\Support\Facades\DB;

class ToolsController extends Controller
{
    public function __invoke()
    {
        // TOTAL TOOLS
        $totalTools = Tool::count();

        // ACTIVE TOOLS
        $activeTools = Tool::where('is_active', true)->count();

        // FEATURED TOOLS
        $featuredTools = Tool::where('is_featured', true)->count();

        // TOOL USAGE STATS
        $topTools = ToolUsageLog::select('tool_slug', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tool_slug')
            ->groupBy('tool_slug')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // ALL TOOLS
        $tools = Tool::latest()->paginate(15);

        return view('admin.tools', compact(
            'totalTools',
            'activeTools',
            'featuredTools',
            'topTools',
            'tools'
        ));
    }
}