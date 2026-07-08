<?php

namespace App\Http\Controllers;

use App\Enums\LeadSource;
use App\Enums\ProgramType;
use App\Models\{Faq, Program, SiteStat, Testimonial};
use App\Support\SiteSettings;

class LandingController extends Controller
{
    public function __invoke()
    {
        return view('landing.index', [
            'stats' => SiteStat::published()->get(),
            'programs' => Program::published()->get(),
            'testimonials' => Testimonial::published()->get(),
            'faqs' => Faq::published()->get(),
            'settings' => SiteSettings::all(),
            'kelasOptions' => ['7 SMP', '8 SMP', '9 SMP', '10 IPA', '10 IPS', '11 IPA', '11 IPS', '12 IPA', '12 IPS'],
            'programOptions' => collect(ProgramType::options())->only(['smp', 'sma_ipa', 'sma_ips', 'utbk'])->all(),
            'sumberOptions' => LeadSource::options(),
        ]);
    }
}
