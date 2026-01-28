<?php

namespace App\Http\Controllers;

use App\Models\Servis;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Customer Homepage
     */
    public function home()
    {
        $pengaturan = Pengaturan::getSettings();
        return view('customer.home', compact('pengaturan'));
    }

    /**
     * Show the tracking form
     */
    public function index()
    {
        $pengaturan = Pengaturan::getSettings();
        return view('tracking.index', compact('pengaturan'));
    }

    /**
     * Show servis status by nomor servis
     */
    public function show(Request $request)
    {
        $nomor = $request->input('nomor');
        
        if (!$nomor) {
            return redirect()->route('tracking.index')
                ->with('error', 'Silakan masukkan nomor servis');
        }

        $servis = Servis::where('nomor_servis', $nomor)->first();
        $pengaturan = Pengaturan::getSettings();

        if (!$servis) {
            return redirect()->route('tracking.index')
                ->with('error', 'Nomor servis tidak ditemukan. Pastikan nomor servis yang Anda masukkan benar.');
        }

        return view('tracking.show', compact('servis', 'pengaturan'));
    }
}
