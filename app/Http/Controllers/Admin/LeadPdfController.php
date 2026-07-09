<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LeadPdfController extends Controller
{
    public function __invoke(Request $r)
    {
        $leads = Lead::query()
            ->when($r->query('status'), fn ($q, $s) => $q->where('status', $s))
            ->when($r->query('search'), fn ($q, $s) => $q->where('nama', 'like', "%{$s}%"))
            ->latest()->get();

        return Pdf::loadView('pdf.leads', ['leads' => $leads, 'generatedAt' => now()])
            ->download('leads-'.now()->format('Ymd-His').'.pdf');
    }
}
