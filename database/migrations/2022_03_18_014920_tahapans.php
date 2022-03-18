<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tahapans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahapans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tender_id');
            $table->string('nama');
            $table->date('mulai');
            $table->date('akhir');
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
        Schema::dropIfExists('tahapans');
    }
}
