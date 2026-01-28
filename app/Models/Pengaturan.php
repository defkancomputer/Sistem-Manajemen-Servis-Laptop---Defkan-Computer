<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;

    protected $table = 'pengaturan';

    protected $fillable = [
        'nama_toko',
        'alamat',
        'no_kontak',
        'ketentuan_servis',
    ];

    /**
     * Get the first (or only) settings record
     */
    public static function getSettings()
    {
        return self::first() ?? self::create([
            'nama_toko' => 'Defkan Computer',
            'alamat' => 'Alamat Toko',
            'no_kontak' => '08xxxxxxxxxx',
            'ketentuan_servis' => "1. Barang yang tidak diambil dalam 3 bulan bukan tanggung jawab kami.\n2. Kerusakan akibat kesalahan pengguna tidak termasuk garansi.\n3. Service akan dilanjutkan setelah panjar minimal 50% dari total biaya.",
        ]);
    }
}
