<?php

namespace App\Support;

class SafeRedirect
{
    public static function to(?string $next, string $fallback): string
    {
        if (! is_string($next) || $next === '') {
            return $fallback;
        }
        // Harus mulai dengan satu slash, bukan '//' (protocol-relative), tanpa skema/backslash.
        if (! str_starts_with($next, '/') || str_starts_with($next, '//')) {
            return $fallback;
        }
        if (str_contains($next, '\\') || preg_match('#^/\s*\\\\#', $next)) {
            return $fallback;
        }
        return $next;
    }
}
