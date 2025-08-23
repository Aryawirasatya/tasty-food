<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\InformasiKontak;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = InformasiKontak::first();
        return view('public.kontak.index', compact('kontak'));
    }

    public function kirimPesan(Request $request)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'email'           => 'required|email',
            'subject'         => 'required|string|max:255',
            'pesan'           => 'required|string',
            'recaptcha_token' => 'required|string',
        ]);

        // Verifikasi reCAPTCHA v3
        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret'   => config('services.recaptcha.secret_key'),
                'response' => $validated['recaptcha_token'],
                'remoteip' => $request->ip(),
            ]
        );

        $result = $response->json();

        if (!($result['success'] ?? false)) {
            return back()->withErrors([
                'recaptcha' => 'Verifikasi reCAPTCHA gagal (success=false).'
            ])->withInput();
        }

        if (($result['score'] ?? 0) < 0.5) {
            return back()->withErrors([
                'recaptcha' => 'Skor reCAPTCHA rendah. Silakan coba lagi.'
            ])->withInput();
        }

        // Simpan pesan
        ContactMessage::create([
            'nama'            => $validated['nama'],
            'email'           => $validated['email'],
            'subject'         => $validated['subject'],
            'pesan'           => $validated['pesan'],
            // opsional: simpan skor
            'recaptcha_score' => (float) ($result['score'] ?? 0),
        ]);

        return redirect()->route('kontak')->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
