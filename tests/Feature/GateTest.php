<?php

test('login diblok gerbang saat kode diset', function () {
    config(['app.admin_gate_code' => 'RAHASIA']);
    $this->get('/login')->assertRedirect(route('gate.show', ['next' => 'login']));
});

test('kode benar melewatkan gerbang', function () {
    config(['app.admin_gate_code' => 'RAHASIA']);
    $this->post('/gate', ['code' => 'RAHASIA', 'next' => 'login'])
        ->assertRedirect('/login')->assertCookie('gate_passed');
});

test('fail-open saat kode kosong: login langsung bisa', function () {
    config(['app.admin_gate_code' => null]);
    $this->get('/login')->assertOk();
});

test('callback reset password tidak diblok gerbang', function () {
    config(['app.admin_gate_code' => 'RAHASIA']);
    $this->get('/reset-password/faketoken')->assertOk();
});
