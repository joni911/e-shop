<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_pesertas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peserta_id');
            $table->bigInteger('tender_id');
            $table->bigInteger('user_id');
            $table->string('administrasi')->nullable();
            $table->string('kualifikasi')->nullable();
            $table->string('teknis')->nullable();
            $table->string('penawaran_peserta')->nullable();
            $table->string('kesimpulan')->nullable();
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
        Schema::dropIfExists('penilaian_pesertas');
    }
}
