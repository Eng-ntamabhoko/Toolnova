
    <?php

use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\TrackVisitor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            TrackVisitor::class,
        ]);

        $middleware->alias([
            'admin' => EnsureAdmin::class,
        ]);
        $middleware->trustProxies(
        at: '*',
        headers: \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
                 \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
                 \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT |
                 \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO
    );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();