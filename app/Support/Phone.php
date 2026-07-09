<?php

namespace App\Support;

class Phone
{
    /** Normalize an Indonesian phone number to wa.me international format (62…). */
    public static function wa(?string $raw): string
    {
        $digits = preg_replace('/\D/', '', (string) $raw); // strip +, spaces, dashes, parens
        if ($digits === '') {
            return '';
        }
        if (str_starts_with($digits, '62')) {
            return $digits;
        }
        if (str_starts_with($digits, '0')) {
            return '62'.substr($digits, 1);
        }
        if (str_starts_with($digits, '8')) {
            return '62'.$digits;
        }

        return $digits;
    }
}
