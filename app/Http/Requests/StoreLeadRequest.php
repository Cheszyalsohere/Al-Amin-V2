<?php

namespace App\Http\Requests;

use App\Enums\LeadSource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeadRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $phone = ['regex:/^[0-9+\-\s()]{9,20}$/'];

        return [
            'nama' => ['required', 'string', 'max:80'],
            'no_hp' => array_merge(['required', 'string', 'max:20'], $phone),
            'no_hp_ortu' => array_merge(['required', 'string', 'max:20'], $phone),
            'email' => ['nullable', 'email', 'max:255'],
            'asal_sekolah' => ['nullable', 'string', 'max:120'],
            'kelas' => ['required', 'string', 'max:24'],
            'program_minat' => ['required', Rule::in(['smp', 'sma_ipa', 'sma_ips', 'utbk'])],
            'sumber' => ['required', Rule::in(array_keys(LeadSource::options()))],
            'catatan' => ['nullable', 'string', 'max:2000'],
            'website' => ['nullable'], // honeypot
        ];
    }

    public function messages(): array
    {
        return [
            'no_hp.regex' => 'Nomor WhatsApp tidak valid.',
            'no_hp_ortu.regex' => 'Nomor WhatsApp orang tua tidak valid.',
        ];
    }
}
