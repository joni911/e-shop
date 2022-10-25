<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_tenders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tender_id');
            $table->bigInteger('peserta_id');
            $table->bigInteger('user_id');
            $table->string('pendaftaran');
            $table->string('pengalaman');
            $table->string('tenaga_ahli');
            $table->string('peraltan');
            $table->string('pekerjaan_berjalan');
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
        Schema::dropIfExists('proses_tenders');
    }
}
