<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetFkFromDetailAlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->foreign('barcode_alat')->references('barcode_alat')->on('detail_alat');
        });
        Schema::table('laporan_kerusakan', function (Blueprint $table) {
            $table->foreign('barcode_alat')->references('barcode_alat')->on('detail_alat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_alat', function (Blueprint $table) {
            //
        });
    }
}
