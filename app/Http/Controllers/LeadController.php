<?php

namespace App\Http\Controllers;

use App\Enums\LeadStatus;
use App\Http\Requests\StoreLeadRequest;
use App\Mail\NewLeadNotification;
use App\Models\Lead;
use App\Support\SiteSettings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request)
    {
        // Honeypot: kalau terisi, pura-pura sukses tanpa simpan.
        if (filled($request->input('website'))) {
            return redirect()->away($this->waUrl($request->input('nama', ''), $request->input('kelas', '')));
        }

        $lead = Lead::create([
            ...$request->safe()->except('website'),
            'sumber' => $request->input('sumber'),
            'status' => LeadStatus::Baru,
            'utm_source' => $request->query('utm_source'),
            'utm_campaign' => $request->query('utm_campaign'),
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        if (config('services.lead_notify')) {
            try {
                Mail::to(config('services.lead_notify_email'))->send(new NewLeadNotification($lead));
            } catch (\Throwable $e) {
                Log::warning('Gagal kirim notif lead: '.$e->getMessage());
            }
        }

        return redirect()->away($this->waUrl($lead->nama, $lead->kelas));
    }

    private function waUrl(string $nama, string $kelas): string
    {
        $wa = SiteSettings::get('wa_number');
        $text = rawurlencode("Halo admin Al-Amin, saya {$nama} ({$kelas}) baru daftar via website. Mohon info lebih lanjut.");

        return "https://wa.me/{$wa}?text={$text}";
    }
}
