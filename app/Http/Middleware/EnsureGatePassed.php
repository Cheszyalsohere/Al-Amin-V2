<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureGatePassed
{
    public function handle(Request $request, Closure $next)
    {
        $code = config('app.admin_gate_code');

        // Fail-open: kalau kode tak diset, jangan kunci apa pun (cegah lockout).
        if (blank($code)) {
            return $next($request);
        }

        if ($request->cookie('gate_passed') === hash('sha256', $code)) {
            return $next($request);
        }

        return redirect()->route('gate.show', ['next' => $request->path()]);
    }
}
