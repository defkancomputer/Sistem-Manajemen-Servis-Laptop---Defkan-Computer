<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaturan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default settings
        Pengaturan::create([
            'nama_toko' => 'Defkan Computer',
            'alamat' => 'Jl. Gubernur Sewaka No.102, Sambongjaya, Kec. Mangkubumi, Tasikmalaya, Jawa Barat 46181 (Depan RM Saung Jembar samping Indomaret/SPX)',
            'no_kontak' => '08123456789',
            'ketentuan_servis' => "1. Barang yang tidak diambil dalam 3 bulan bukan tanggung jawab kami.\n2. Kerusakan akibat kesalahan pengguna tidak termasuk garansi.\n3. Service akan dilanjutkan setelah panjar minimal 50% dari total biaya.\n4. Garansi tidak berlaku jika segel rusak atau dibongkar pihak lain.",
        ]);
    }
}
