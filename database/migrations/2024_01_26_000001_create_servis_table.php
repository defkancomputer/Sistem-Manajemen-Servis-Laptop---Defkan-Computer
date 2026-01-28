<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_servis', 20)->unique();
            $table->string('nama_konsumen', 100);
            $table->string('no_hp', 20);
            $table->date('tanggal_masuk');
            $table->date('tanggal_jadi')->nullable();
            $table->string('type_laptop', 100);
            $table->text('jenis_kerusakan');
            $table->boolean('kelengkapan_laptop')->default(false);
            $table->boolean('kelengkapan_charger')->default(false);
            $table->boolean('kelengkapan_baterai')->default(false);
            $table->boolean('kelengkapan_tas')->default(false);
            $table->string('kelengkapan_lainnya', 255)->nullable();
            $table->string('nama_teknisi', 100);
            $table->enum('status', ['Masuk', 'Dicek', 'Proses', 'Selesai', 'Diambil'])->default('Masuk');
            $table->text('catatan_teknisi')->nullable();
            $table->decimal('panjar', 12, 2)->default(0);
            $table->decimal('total_biaya', 12, 2)->default(0);
            $table->integer('garansi_nilai')->default(0);
            $table->enum('garansi_satuan', ['Hari', 'Pekan', 'Bulan'])->default('Hari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servis');
    }
};
