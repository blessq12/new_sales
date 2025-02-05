<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheControl
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->getStatusCode() === 200) {
            $path = $request->getPathInfo();
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            if ($extension && isset(config('cache-control.extensions')[$extension])) {
                $duration = config('cache-control.extensions')[$extension];

                $response->header('Cache-Control', 'public, max-age=' . $duration);
                $response->header('Pragma', 'public');
                $response->header('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + $duration));
            }
        }

        return $response;
    }
}
