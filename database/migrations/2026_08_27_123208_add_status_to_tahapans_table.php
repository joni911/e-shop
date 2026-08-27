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
        Schema::table('tahapans', function (Blueprint $table) {
            // Jenis tahapan: 0=Biasa, 1=Masa Pendaftaran, 2=Masa Pembukaan File,
            // 3=Pengumuman Pemenang, 4=Upload File (Dipakai TenderHomeController@show)
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tahapans', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};