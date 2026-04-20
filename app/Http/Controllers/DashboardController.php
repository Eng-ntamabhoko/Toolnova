<?php

namespace App\Http\Controllers;

use App\Models\UserCv;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Statistics
        $stats = [
            'total_resumes' => 0,
            'total_cvs' => UserCv::where('user_id', $user->id)->count(),
            'total_invoices' => 0,
        ];

        // TODO: Once models exist, replace with actual data
        // $stats['total_resumes'] = Resume::where('user_id', $user->id)->count();
        // $stats['total_invoices'] = Invoice::where('user_id', $user->id)->count();

        return view('dashboard.index', compact('user', 'stats'));
    }

    public function profile(Request $request)
    {
        $user = auth()->user();
        return view('dashboard.profile', compact('user'));
    }

    public function resumes(Request $request)
    {
        $user = auth()->user();
        // TODO: Once Resume model exists:
        // $resumes = Resume::where('user_id', $user->id)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(10);
        $resumes = collect();
        
        return view('dashboard.resumes', compact('user', 'resumes'));
    }

    public function cvs(Request $request)
    {
        $user = auth()->user();
        $cvs = UserCv::where('user_id', $user->id)->latest()->paginate(10);
        
        return view('dashboard.cvs', compact('user', 'cvs'));
    }

    public function invoices(Request $request)
    {
        $user = auth()->user();
        // TODO: Once Invoice model exists:
        // $invoices = Invoice::where('user_id', $user->id)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(10);
        $invoices = collect();
        
        return view('dashboard.invoices', compact('user', 'invoices'));
    }

    public function downloads(Request $request)
    {
        $user = auth()->user();
        
        // Placeholder for download history
        // TODO: Once tracking is implemented:
        // $downloads = UserDownload::where('user_id', $user->id)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(15);
        $downloads = collect();
        
        return view('dashboard.downloads', compact('user', 'downloads'));
    }

    public function settings(Request $request)
    {
        $user = auth()->user();
        return view('dashboard.settings', compact('user'));
    }
}
