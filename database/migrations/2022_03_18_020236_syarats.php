<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Syarats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syarats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tender_id');
            $table->string('judul');
            $table->string('izin');
            $table->string('usaha');
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
        Schema::dropIfExists('syarats');
    }
}
