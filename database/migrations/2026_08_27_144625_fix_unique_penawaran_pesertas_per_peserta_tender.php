<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Peserta boleh mengikuti BANYAK tender, tapi hanya 1 penawaran per (peserta, tender).
     * Ganti unique tunggal peserta_id -> unique composite (peserta_id, tender_id).
     */
    public function up(): void
    {
        Schema::table('penawaran_pesertas', function (Blueprint $table) {
            $table->dropUnique('penawaran_pesertas_peserta_id_unique');
            $table->unique(['peserta_id', 'tender_id'], 'penawaran_pesertas_peserta_tender_unique');
        });
    }

    public function down(): void
    {
        Schema::table('penawaran_pesertas', function (Blueprint $table) {
            $table->dropUnique('penawaran_pesertas_peserta_tender_unique');
            $table->unique('peserta_id', 'penawaran_pesertas_peserta_id_unique');
        });
    }
};