<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetFkFromAlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_alat', function (Blueprint $table) {
            $table->foreign('alat_id')->references('id')->on('alat')->onDelete('cascade');
        });
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->foreign('alat_id')->references('id')->on('alat')->onDelete('cascade');
        });
        Schema::table('image_alat', function (Blueprint $table) {
            $table->foreign('alat_id')->references('id')->on('alat')->onDelete('cascade');
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
