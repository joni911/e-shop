<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekerjaanBerjalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekerjaan_berjalans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('tender_id');
            $table->bigInteger('peserta_id');
            $table->string('pekerjaan');
            $table->string('lokasi');
            $table->string('instansi');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('no_kontrak');
            $table->date('tgl_kontrak')->nullable();
            $table->integer('presentasi');
            $table->date('tgl_selesai_kontrak');
            $table->date('tgl_serah_terima');
            $table->longText('keterangan')->nullable();
            $table->string('nilai_kontrak');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pekerjaan_berjalans');
    }
}
