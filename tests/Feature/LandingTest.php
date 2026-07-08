<?php

use App\Models\Program;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('landing tampil 200 & memakai fallback kontak saat db kosong', function () {
    $this->get('/')->assertOk()->assertSee('0851-9090-9689');
});

test('landing menampilkan program & testimoni yang published', function () {
    Program::create(['kode' => 'X', 'nama' => 'Program Uji', 'deskripsi' => 'desk', 'tags' => ['a'], 'is_published' => true]);
    Testimonial::create(['nama' => 'Siswa Uji', 'sekolah' => 'S', 'quote' => 'mantap', 'is_published' => true]);

    $this->get('/')->assertSee('Program Uji')->assertSee('Siswa Uji');
});

test('konten unpublished tidak tampil', function () {
    Program::create(['kode' => 'Y', 'nama' => 'Rahasia', 'deskripsi' => 'd', 'is_published' => false]);
    $this->get('/')->assertDontSee('Rahasia');
});
