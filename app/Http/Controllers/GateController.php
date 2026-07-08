<?php

namespace App\Http\Controllers;

use App\Support\SafeRedirect;
use Illuminate\Http\Request;

class GateController extends Controller
{
    public function show(Request $request)
    {
        return view('gate', ['next' => $request->query('next', 'login')]);
    }

    public function submit(Request $request)
    {
        $request->validate(['code' => ['required', 'string']]);
        $code = config('app.admin_gate_code');

        if (blank($code) || hash_equals((string) $code, (string) $request->input('code'))) {
            $target = SafeRedirect::to('/'.ltrim($request->input('next', 'login'), '/'), '/login');

            return redirect($target)->cookie('gate_passed', hash('sha256', (string) $code), 60 * 24 * 30, null, null, false, true);
        }

        return back()->withErrors(['code' => 'Kode akses salah.']);
    }
}
