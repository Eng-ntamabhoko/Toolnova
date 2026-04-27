<?php

namespace App\Http\Middleware;

use App\Services\AnalyticsService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function __construct(
        protected AnalyticsService $analyticsService
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (
            $request->isMethod('get') &&
            !$request->expectsJson() &&
            !$request->is('build/*') &&
            !$request->is('_debugbar/*')
        ) {
            $toolSlug = $this->detectToolSlug($request->path());

            $this->analyticsService->log(
                request: $request,
                actionType: 'page_view',
                toolSlug: $toolSlug,
                meta: [
                    'method' => $request->method(),
                ]
            );
        }

        return $response;
    }

    protected function detectToolSlug(string $path): ?string
    {
        $toolSlugs = [
            'age-calculator',
            'word-counter',
            'password-generator',
            'json-formatter',
            'qr-code-generator',
            'image-compressor',
            'image-resizer',
            'percentage-calculator',
            'discount-calculator',
            'loan-calculator',
            'base64-encoder-decoder',
            'text-case-converter',
            'random-name-generator',
            'resume-builder',
            'invoice-generator',
        ];

        foreach ($toolSlugs as $slug) {
            if ($path === "tools/{$slug}" || $path === $slug) {
                return $slug;
            }
        }

        return null;
    }
}