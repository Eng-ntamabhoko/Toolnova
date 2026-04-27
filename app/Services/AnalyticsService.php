<?php

namespace App\Services;

use App\Models\Tool;
use App\Models\ToolUsageLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Agent\Agent;

class AnalyticsService
{
    public function log(Request $request, string $actionType = 'page_view', ?string $toolSlug = null, ?array $meta = null): void
    {
        if ($request->is('admin*')) {
            return;
        }

        if (! Schema::hasTable('tool_usage_logs')) {
            // If the analytics table doesn't exist yet, skip logging to avoid crashing.
            return;
        }

        $session = $request->session();
        $sessionId = $session ? $session->getId() : null;

        if ($session && !$session->has('landing_page')) {
            $session->put('landing_page', $request->fullUrl());
        }

        $agent = new Agent();
        $agent->setUserAgent($request->userAgent() ?? '');

        $toolId = null;
        if ($toolSlug && Schema::hasTable('tools')) {
            $toolId = Tool::where('slug', $toolSlug)->value('id');
        }

        $pageUrl = $request->fullUrl();
        if (is_array($meta) && array_key_exists('page_url', $meta) && $meta['page_url']) {
            $pageUrl = $meta['page_url'];
        }

        ToolUsageLog::create([
            'user_id'      => auth()->id(),
            'tool_id'      => $toolId,
            'tool_slug'    => $this->normalizeToolSlug($toolSlug),
            'session_id'   => $sessionId,
            'ip_address'   => $this->resolveIp($request),
            'country'      => $this->normalizeCountry($this->resolveCountry($request)),
            'city'         => $this->normalizeCity($this->resolveCity($request)),
            'browser'      => $this->normalizeBrowser($agent->browser()),
            'device'       => $this->normalizeDevice($this->resolveDevice($agent)),
            'os'           => $this->normalizeOs($agent->platform()),
            'referrer'     => $this->normalizeReferrer($request->headers->get('referer')),
            'landing_page' => $session?->get('landing_page'),
            'page_url'     => $pageUrl,
            'action_type'  => $this->normalizeActionType($actionType),
            'meta'         => $meta,
        ]);
    }

    protected function resolveIp(Request $request): ?string
    {
        return $request->headers->get('CF-Connecting-IP')
            ?? $request->headers->get('X-Forwarded-For')
            ?? $request->ip();
    }

    protected function resolveCountry(Request $request): ?string
    {
        return $request->headers->get('CF-IPCountry')
            ?? $request->headers->get('X-Country-Code')
            ?? null;
    }

    protected function resolveCity(Request $request): ?string
    {
        return $request->headers->get('X-City')
            ?? null;
    }

    protected function resolveDevice(Agent $agent): string
    {
        if ($agent->isTablet()) {
            return 'Tablet';
        }

        if ($agent->isMobile()) {
            return 'Mobile';
        }

        return 'Desktop';
    }

    protected function normalizeDevice(?string $value): string
    {
        $value = trim((string) ($value ?? ''));

        if ($value === '') {
            return 'Unknown';
        }

        $normalized = strtolower($value);

        return match ($normalized) {
            'mobile' => 'Mobile',
            'desktop' => 'Desktop',
            'tablet' => 'Tablet',
            default => ucfirst($normalized),
        };
    }

    protected function normalizeBrowser(?string $value): string
    {
        $value = trim((string) ($value ?? ''));

        if ($value === '') {
            return 'Unknown';
        }

        $normalized = strtolower($value);

        return match ($normalized) {
            'chrome' => 'Chrome',
            'firefox' => 'Firefox',
            'safari' => 'Safari',
            'edge' => 'Edge',
            'opera' => 'Opera',
            default => ucfirst($normalized),
        };
    }

    protected function normalizeOs(?string $value): string
    {
        $value = trim((string) ($value ?? ''));

        if ($value === '') {
            return 'Unknown';
        }

        $normalized = strtolower($value);

        return match ($normalized) {
            'windows' => 'Windows',
            'macos', 'mac os', 'mac' => 'macOS',
            'ios' => 'iOS',
            'android' => 'Android',
            'linux' => 'Linux',
            default => ucfirst($normalized),
        };
    }

    protected function normalizeCountry(?string $value): ?string
    {
        $value = trim((string) ($value ?? ''));

        if ($value === '') {
            return null;
        }

        return strlen($value) <= 3
            ? strtoupper($value)
            : ucwords(strtolower($value));
    }

    protected function normalizeCity(?string $value): ?string
    {
        $value = trim((string) ($value ?? ''));

        if ($value === '') {
            return null;
        }

        return ucwords(strtolower($value));
    }

    protected function normalizeReferrer(?string $value): ?string
    {
        $value = trim((string) ($value ?? ''));

        if ($value === '') {
            return null;
        }

        $host = parse_url($value, PHP_URL_HOST);
        $referrer = $host ? preg_replace('/^www\./', '', $host) : null;

        if ($referrer === '127.0.0.1' || $referrer === 'localhost') {
            return null;
        }

        return $referrer;
    }

    protected function normalizeToolSlug(?string $value): ?string
    {
        $value = trim((string) ($value ?? ''));

        if ($value === '') {
            return null;
        }

        return strtolower($value);
    }

    protected function normalizeActionType(string $value): string
    {
        $value = trim($value);

        return str_replace(' ', '_', strtolower($value));
    }
}