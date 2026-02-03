<?php

namespace App\Http\Controllers;

use App\Models\Servis;
use App\Models\Pengaturan;
use App\Models\TrackingLog;
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

        // Log customer visit
        TrackingLog::create([
            'servis_id' => $servis->id,
            'nomor_servis' => $servis->nomor_servis,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);

        return view('tracking.show', compact('servis', 'pengaturan'));
    }

    /**
     * Admin: Show tracking logs
     */
    public function logs(Request $request)
    {
        $query = TrackingLog::with('servis')->orderBy('created_at', 'desc');

        // Filter by date
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Filter by nomor servis
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_servis', 'like', "%{$search}%")
                  ->orWhereHas('servis', function($subQ) use ($search) {
                      $subQ->where('nama_konsumen', 'like', "%{$search}%");
                  });
            });
        }

        $logs = $query->paginate(20);
        $totalToday = TrackingLog::whereDate('created_at', today())->count();
        $totalAll = TrackingLog::count();

        return view('tracking.logs', compact('logs', 'totalToday', 'totalAll'));
    }
}
