<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TrackPageView
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            $shouldTrack = $request->isMethod('GET')
                && ! $request->is('admin/*', 'login', 'logout', 'gate', 'daftar', 'forgot-password', 'reset-password/*', 'profile')
                && $response->getStatusCode() === 200
                && str_contains((string) $response->headers->get('content-type'), 'text/html');

            if ($shouldTrack) {
                $vid = $request->cookie('vid');
                $isUnique = blank($vid);

                if ($isUnique) {
                    $vid = (string) Str::uuid();
                    cookie()->queue(cookie('vid', $vid, 60 * 24 * 30));
                }

                $path = '/'.ltrim($request->path(), '/');

                PageView::create([
                    'path' => $path,
                    'visitor_id' => $vid,
                    'is_unique' => $isUnique,
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('page view track gagal: '.$e->getMessage());
        }

        return $response;
    }
}
