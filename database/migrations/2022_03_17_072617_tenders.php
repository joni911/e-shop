<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tenders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tahapan_id');
            $table->bigInteger('jenis_pegadaan_id');
            $table->bigInteger('metode_pengadaan_id');
            $table->bigInteger('jenis_kontrak_id');
            $table->bigInteger('syarat_id');
            $table->bigInteger('status_tender_id');
            $table->string('nama');
            $table->string('paket');
            $table->string('sumber_dana');
            $table->string('KLPD');
            $table->string('satuan_kerja');
            $table->date('tahun_anggaran');
            $table->string('lokasi_pekerjaan');

            $table->timestamps();
$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenders');
    }
}
