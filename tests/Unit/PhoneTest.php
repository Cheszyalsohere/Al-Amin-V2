<?php

use App\Support\Phone;

test('normalizes indonesian phone numbers to wa.me format', function () {
    expect(Phone::wa('081234567890'))->toBe('6281234567890');
    expect(Phone::wa('+6281234567890'))->toBe('6281234567890');
    expect(Phone::wa('6281234567890'))->toBe('6281234567890');
    expect(Phone::wa('0851-9090-9689'))->toBe('6285190909689');
    expect(Phone::wa('81234'))->toBe('6281234');
    expect(Phone::wa(''))->toBe('');
});
