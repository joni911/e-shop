<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAktaToPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesertas', function (Blueprint $table) {
            //
            $table->string('notaris');
            $table->string('no_akta');
            $table->string('tgl_akta');
            $table->string('notaris_b');
            $table->string('no_aktab');
            $table->string('tgl_aktab');
            $table->string('kswp_npwp');
            $table->string('kswp_nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesertas', function (Blueprint $table) {
            //
        });
    }
}
