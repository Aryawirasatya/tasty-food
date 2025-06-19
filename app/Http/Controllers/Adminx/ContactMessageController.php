<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        if (!auth()->user()?->canAkses('akses_pesan')) {
            abort(403);
        }

        $pesan = ContactMessage::latest()->get();
        return view('admin.kontak.pesan.index', compact('pesan'));
    }

    public function show(ContactMessage $kontak_pesan)
    {
        if (!auth()->user()?->canAkses('akses_pesan')) {
            abort(403);
        }

return view('admin.kontak.pesan.show', compact('kontak_pesan'));
    }

    public function destroy(ContactMessage $kontak_pesan)
    {
        if (!auth()->user()?->canAkses('akses_pesan')) {
            abort(403);
        }

        $kontak_pesan->delete();

        return redirect()
            ->route('admin.kontak-pesan.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
