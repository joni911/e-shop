<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropInventoryBarangIdToBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropColumn('inventory_barang_id');
            $table->dropColumn('deal_barang_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->bigInteger('inventory_barang_id');
            $table->bigInteger('deal_barang_id');
        });
    }
}
