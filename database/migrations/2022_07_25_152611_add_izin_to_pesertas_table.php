<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIzinToPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesertas', function (Blueprint $table) {
            //
            $table->string('izin');
            $table->string('nomor_izin');
            $table->date('izin_berlaku')->nullable();
            $table->string('instansi_pemberi');
            $table->string('kualifikasi');
            $table->string('klasifikasi');
            $table->string('nama_pt');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesertas', function (Blueprint $table) {
            //
        });
    }
}
