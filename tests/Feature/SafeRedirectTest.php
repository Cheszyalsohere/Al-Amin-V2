<?php

use App\Support\SafeRedirect;

test('izinkan path internal', function () {
    expect(SafeRedirect::to('/dashboard', '/'))->toBe('/dashboard');
});

test('tolak url absolut & protocol-relative', function () {
    expect(SafeRedirect::to('https://evil.com', '/'))->toBe('/');
    expect(SafeRedirect::to('//evil.com', '/'))->toBe('/');
    expect(SafeRedirect::to('http:evil', '/'))->toBe('/');
    expect(SafeRedirect::to(null, '/home'))->toBe('/home');
});
