<?php

namespace App\Http\Controllers;

use App\Enums\ServisStatus;
use App\Models\Servis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = today();
        
        // Statistics
        $totalHariIni = Servis::whereDate('tanggal_masuk', $today)->count();
        $servisProses = Servis::whereIn('status', [
            ServisStatus::MASUK, 
            ServisStatus::DICEK, 
            ServisStatus::PROSES
        ])->count();
        $servisSelesai = Servis::where('status', ServisStatus::SELESAI)->count();
        $belumDiambil = Servis::where('status', ServisStatus::SELESAI)->count(); // Actually Selesai means it's ready but not yet taken
        
        // Recent services
        $servisTerbaru = Servis::orderBy('created_at', 'desc')->limit(10)->get();
        
        return view('dashboard.index', compact(
            'totalHariIni',
            'servisProses',
            'servisSelesai',
            'belumDiambil',
            'servisTerbaru'
        ));
    }
}
