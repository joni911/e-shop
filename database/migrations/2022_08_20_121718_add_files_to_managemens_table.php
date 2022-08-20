<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilesToManagemensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('managemens', function (Blueprint $table) {
            //
            $table->string('file1');
            $table->string('ket1');
            $table->string('file2')->nullable();
            $table->string('ket2')->nullable();
            $table->string('file3')->nullable();
            $table->string('ket3')->nullable();
            $table->string('file4')->nullable();
            $table->string('ket4')->nullable();
            $table->string('file5')->nullable();
            $table->string('ket5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('managemens', function (Blueprint $table) {
            //
        });
    }
}
