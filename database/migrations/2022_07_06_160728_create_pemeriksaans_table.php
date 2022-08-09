<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('tender_id');
            $table->bigInteger('peserta_id')->unique();
            $table->string('pengalaman');
            $table->longText('kpengalaman')->nullable();
            $table->string('tenaga_ahli');
            $table->longText('ktenaga_ahli')->nullable();
            $table->string('peralatan');
            $table->longText('kperalatan')->nullable();
            $table->string('pekerjaan_berjalan');
            $table->longText('kpekerjaan_berjalan')->nullable();
            $table->string('managemen');
            $table->longText('kmanagemen')->nullable();
            $table->string('file');
            $table->longText('kfile')->nullable();
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
        Schema::dropIfExists('pemeriksaans');
    }
}
