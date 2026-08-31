<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ganti kolom `ktp` pada tabel managemens menjadi `no_rekening` + `master_id`
     * (permintaan pengguna: tidak lagi memakai No KTP, diganti No Rekening & Master ID Nasabah).
     */
    public function up(): void
    {
        Schema::table('managemens', function (Blueprint $table) {
            if (Schema::hasColumn('managemens', 'ktp')) {
                $table->dropColumn('ktp');
            }
            if (! Schema::hasColumn('managemens', 'no_rekening')) {
                $table->string('no_rekening')->nullable()->after('tgl_berakhir');
            }
            if (! Schema::hasColumn('managemens', 'master_id')) {
                $table->string('master_id')->nullable()->after('no_rekening');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('managemens', function (Blueprint $table) {
            if (Schema::hasColumn('managemens', 'no_rekening')) {
                $table->dropColumn('no_rekening');
            }
            if (Schema::hasColumn('managemens', 'master_id')) {
                $table->dropColumn('master_id');
            }
            if (! Schema::hasColumn('managemens', 'ktp')) {
                $table->string('ktp')->nullable()->after('tgl_berakhir');
            }
        });
    }
};
