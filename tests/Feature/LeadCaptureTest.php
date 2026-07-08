<?php

use App\Models\Lead;
use App\Mail\NewLeadNotification;
use Illuminate\Support\Facades\Mail;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

function validPayload(array $override = []): array {
    return array_merge([
        'nama' => 'Siti Aminah', 'no_hp' => '081234567890', 'no_hp_ortu' => '081298765432',
        'kelas' => '12 IPA', 'program_minat' => 'utbk', 'sumber' => 'website', 'website' => '',
    ], $override);
}

test('lead valid tersimpan & redirect ke whatsapp', function () {
    $res = $this->post('/daftar', validPayload());
    $res->assertRedirect();
    expect($res->headers->get('Location'))->toContain('wa.me/6285190909689');
    expect(Lead::where('nama', 'Siti Aminah')->exists())->toBeTrue();
});

test('honeypot terisi: pura-pura sukses tanpa simpan', function () {
    $this->post('/daftar', validPayload(['website' => 'http://spam']))->assertRedirect();
    expect(Lead::count())->toBe(0);
});

test('validasi menolak nama kosong & nomor invalid', function () {
    $this->from('/')->post('/daftar', validPayload(['nama' => '', 'no_hp' => 'abc']))
        ->assertRedirect('/')->assertSessionHasErrors(['nama', 'no_hp']);
    expect(Lead::count())->toBe(0);
});

test('email dikirim saat notif aktif', function () {
    config(['services.lead_notify' => true]);
    Mail::fake();
    $this->post('/daftar', validPayload());
    Mail::assertSent(NewLeadNotification::class);
});

test('menangkap utm, ip, user agent', function () {
    $this->post('/daftar?utm_source=ig&utm_campaign=promo', validPayload());
    $lead = Lead::first();
    expect($lead->utm_source)->toBe('ig');
    expect($lead->ip_address)->not->toBeNull();
});
