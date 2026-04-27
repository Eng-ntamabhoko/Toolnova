<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::pluck('setting_value', 'setting_key');

        return view('admin.settings', [
            'settings' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'support_email' => ['nullable', 'email', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'default_meta_title' => ['nullable', 'string', 'max:255'],
            'default_meta_description' => ['nullable', 'string', 'max:500'],
            'maintenance_mode_message' => ['nullable', 'string', 'max:1000'],
            'enable_user_registration' => ['nullable', 'boolean'],
            'enable_public_contact_form' => ['nullable', 'boolean'],
            'enable_blog' => ['nullable', 'boolean'],
            'enable_ads' => ['nullable', 'boolean'],
        ]);

        $booleanKeys = [
            'enable_user_registration',
            'enable_public_contact_form',
            'enable_blog',
            'enable_ads',
        ];

        foreach ($booleanKeys as $key) {
            $validated[$key] = $request->boolean($key) ? '1' : '0';
        }

        $stringKeys = [
            'site_name',
            'site_tagline',
            'support_email',
            'contact_email',
            'default_meta_title',
            'default_meta_description',
            'maintenance_mode_message',
        ];

        foreach ($stringKeys as $key) {
            $validated[$key] = $validated[$key] ?? null;
        }

        foreach ($validated as $key => $value) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}