<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::getSettings();
        return view('pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_toko' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'no_kontak' => 'nullable|string|max:50',
            'ketentuan_servis' => 'nullable|string',
        ]);

        $pengaturan = Pengaturan::getSettings();
        $pengaturan->update($validated);

        return redirect()->route('pengaturan')
            ->with('success', 'Pengaturan berhasil disimpan!');
    }
}
