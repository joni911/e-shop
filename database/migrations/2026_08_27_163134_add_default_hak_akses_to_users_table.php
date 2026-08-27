<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bikin kolom users.hak_akses punya DEFAULT 'user' di level database.
     * (Sebelumnya default hanya di-hardcode di RegisterController.)
     */
    public function up(): void
    {
        // Backfill nilai NULL (jika ada) menjadi 'user'
        DB::table('users')
            ->whereNull('hak_akses')
            ->update(['hak_akses' => 'user']);

        Schema::table('users', function (Blueprint $table) {
            $table->string('hak_akses')->default('user')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // kembalikan tanpa default (NOT NULL) — nilai lama tetap diisi dari kode
            $table->string('hak_akses')->default(null)->change();
        });
    }
};
