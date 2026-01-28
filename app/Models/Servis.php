<?php

namespace App\Models;

use App\Enums\ServisStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servis extends Model
{
    use HasFactory;

    protected $table = 'servis';

    protected $fillable = [
        'nomor_servis',
        'nama_konsumen',
        'no_hp',
        'tanggal_masuk',
        'tanggal_jadi',
        'type_laptop',
        'jenis_kerusakan',
        'kelengkapan_laptop',
        'kelengkapan_charger',
        'kelengkapan_baterai',
        'kelengkapan_tas',
        'kelengkapan_lainnya',
        'nama_teknisi',
        'status',
        'catatan_teknisi',
        'panjar',
        'total_biaya',
        'garansi_nilai',
        'garansi_satuan',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_jadi' => 'date',
        'kelengkapan_laptop' => 'boolean',
        'kelengkapan_charger' => 'boolean',
        'kelengkapan_baterai' => 'boolean',
        'kelengkapan_tas' => 'boolean',
        'panjar' => 'decimal:2',
        'total_biaya' => 'decimal:2',
        'status' => ServisStatus::class,
    ];

    /**
     * Generate nomor servis otomatis
     */
    public static function generateNomorServis(): string
    {
        return DB::transaction(function () {
            $prefix = 'SRV';
            $date = date('Ymd');
            
            $lastServis = self::whereDate('created_at', today())
                ->orderBy('id', 'desc')
                ->lockForUpdate()
                ->first();

            if ($lastServis) {
                $lastNumber = intval(substr($lastServis->nomor_servis, -4));
                $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }

            return $prefix . $date . $newNumber;
        });
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        if ($this->status instanceof ServisStatus) {
            return $this->status->badgeClass();
        }
        
        // Fallback if not cast correctly or using old data
        return match($this->status) {
            'Masuk' => 'badge-masuk',
            'Dicek' => 'badge-dicek',
            'Proses' => 'badge-proses',
            'Selesai' => 'badge-selesai',
            'Diambil' => 'badge-diambil',
            default => 'badge-default',
        };
    }

    /**
     * Get kelengkapan as array
     */
    public function getKelengkapanArray(): array
    {
        $kelengkapan = [];
        if ($this->kelengkapan_laptop) $kelengkapan[] = 'Laptop';
        if ($this->kelengkapan_charger) $kelengkapan[] = 'Charger';
        if ($this->kelengkapan_baterai) $kelengkapan[] = 'Baterai';
        if ($this->kelengkapan_tas) $kelengkapan[] = 'Tas';
        if ($this->kelengkapan_lainnya) $kelengkapan[] = $this->kelengkapan_lainnya;
        return $kelengkapan;
    }

    /**
     * Format currency
     */
    public function formatRupiah($amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    /**
     * Get garansi text
     */
    public function getGaransiText(): string
    {
        if ($this->garansi_nilai <= 0) {
            return 'Tidak ada garansi';
        }
        return $this->garansi_nilai . ' ' . $this->garansi_satuan;
    }
}
