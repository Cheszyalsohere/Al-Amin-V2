<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin update profil termasuk nickname', function () {
    $u = User::factory()->create();
    $this->actingAs($u)->patch('/profile', [
        'name' => 'Heri Baru', 'nickname' => 'Bu Heri', 'email' => $u->email,
    ])->assertRedirect();
    expect($u->fresh()->nickname)->toBe('Bu Heri');
});
