<?php

use App\Http\Controllers\GateController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\FaqsManager;
use App\Livewire\Admin\LeadDetail;
use App\Livewire\Admin\LeadsTable;
use App\Livewire\Admin\Overview;
use App\Livewire\Admin\ProgramsManager;
use App\Livewire\Admin\SettingsForm;
use App\Livewire\Admin\StatsManager;
use App\Livewire\Admin\TestimonialsManager;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class)->name('landing');

Route::get('/gate', [GateController::class, 'show'])->name('gate.show');
Route::post('/gate', [GateController::class, 'submit'])->name('gate.submit');

Route::post('/daftar', [LeadController::class, 'store'])
    ->middleware('throttle:3,1')->name('leads.store');

Route::redirect('/dashboard', '/admin')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', Overview::class)->name('admin.overview');
    Route::get('/leads', LeadsTable::class)->name('admin.leads');
    Route::get('/leads/{lead}', LeadDetail::class)->name('admin.leads.show');
    Route::get('/konten', ProgramsManager::class)->name('admin.konten');
    Route::get('/testimoni', TestimonialsManager::class)->name('admin.testimoni');
    Route::get('/faq', FaqsManager::class)->name('admin.faq');
    Route::get('/statistik', StatsManager::class)->name('admin.statistik');
    Route::get('/pengaturan', SettingsForm::class)->name('admin.pengaturan');
});

require __DIR__.'/auth.php';
