<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Legacy URL: same inbox as Messages (polished UI).
     */
    public function __invoke(): RedirectResponse
    {
        return redirect()->route('admin.messages.index', request()->query());
    }
}
