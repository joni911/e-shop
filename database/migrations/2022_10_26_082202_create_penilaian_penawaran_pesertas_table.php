<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianPenawaranPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_penawaran_pesertas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tender_id');
            $table->bigInteger('user_id');
            $table->bigInteger('peserta_id');
            $table->string('status');
            $table->longText('keterangan');
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
        Schema::dropIfExists('penilaian_penawaran_pesertas');
    }
}
