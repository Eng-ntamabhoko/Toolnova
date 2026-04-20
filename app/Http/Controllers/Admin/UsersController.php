<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ToolUsageLog;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __invoke()
    {
        // TOTAL USERS
        $totalUsers = User::count();

        // ACTIVE USERS (last 7 days)
        $activeUsers = ToolUsageLog::whereNotNull('user_id')
            ->where('created_at', '>=', now()->subDays(7))
            ->distinct('user_id')
            ->count('user_id');

        // NEW USERS (last 7 days)
        $newUsers = User::where('created_at', '>=', now()->subDays(7))->count();

        // USERS WITH MOST ACTIVITY
        $topUsers = ToolUsageLog::select('user_id', DB::raw('COUNT(*) as total'))
            ->whereNotNull('user_id')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get()
            ->map(function ($row) {
                $user = User::find($row->user_id);
                return (object)[
                    'name' => $user->name ?? 'Unknown',
                    'email' => $user->email ?? '-',
                    'total' => $row->total
                ];
            });

        // USERS TABLE (paginated)
        $users = User::latest()->paginate(15);

        return view('admin.users', compact(
            'totalUsers',
            'activeUsers',
            'newUsers',
            'topUsers',
            'users'
        ));
    }
}