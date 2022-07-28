<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenagaAhlisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenaga_ahlis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peserta_id');
            $table->bigInteger('tender_id');
            $table->bigInteger('user_id');
            $table->string('nama');
            $table->date('tgl_lahir')->nullable();
            $table->string('jk');
            $table->longText('alamat');
            $table->string('negara');
            $table->string('jabatan');
            $table->string('pengalaman');
            $table->string('email');
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('tenaga_ahlis');
    }
}
