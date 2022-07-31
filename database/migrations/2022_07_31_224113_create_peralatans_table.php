<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeralatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peralatans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('tender_id');
            $table->bigInteger('peserta_id');
            $table->string('nama');
            $table->string('jumlah');
            $table->string('kapasitas')->nullable();
            $table->string('merk');
            $table->string('tahun');
            $table->string('kondisi');
            $table->string('lokasi');
            $table->string('kepemilikan');
            $table->string('bukti');
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
        Schema::dropIfExists('peralatans');
    }
}
