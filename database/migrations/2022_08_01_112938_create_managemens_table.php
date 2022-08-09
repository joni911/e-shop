<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagemensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managemens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peserta_id');
            $table->bigInteger('tender_id');
            $table->bigInteger('user_id');
            $table->string('nama');
            $table->date('tgl_menjabat')->nullable();
            $table->date('tgl_berakhir')->nullable();
            $table->string('ktp');
            $table->longText('alamat');
            $table->string('npwp');
            $table->string('status');
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
        Schema::dropIfExists('managemens');
    }
}
