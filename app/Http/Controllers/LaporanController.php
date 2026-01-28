<?php

namespace App\Http\Controllers;

use App\Models\Servis;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai ?? today()->startOfMonth()->format('Y-m-d');
        $tanggalAkhir = $request->tanggal_akhir ?? today()->format('Y-m-d');

        $query = Servis::whereBetween('tanggal_masuk', [$tanggalMulai, $tanggalAkhir]);

        // Statistics
        $totalServis = (clone $query)->count();
        $servisSelesai = (clone $query)->where('status', 'Selesai')->count();
        $servisDiambil = (clone $query)->where('status', 'Diambil')->count();
        $belumDiambil = (clone $query)->where('status', 'Selesai')->count();
        $servisProses = (clone $query)->whereIn('status', ['Masuk', 'Dicek', 'Proses'])->count();

        // Total pendapatan
        $totalPanjar = (clone $query)->sum('panjar');
        $totalBiaya = (clone $query)->where('status', 'Diambil')->sum('total_biaya');

        // Data servis
        $servis = $query->orderBy('tanggal_masuk', 'desc')->get();

        return view('laporan.index', compact(
            'tanggalMulai',
            'tanggalAkhir',
            'totalServis',
            'servisSelesai',
            'servisDiambil',
            'belumDiambil',
            'servisProses',
            'totalPanjar',
            'totalBiaya',
            'servis'
        ));
    }
}
