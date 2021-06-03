<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiPenyimpananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_penyimpanan', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi_name');
            $table->integer('total_capacity'); //Kapasitas Total
            $table->integer('available_capacity'); //Kapasitas Tersedia
            $table->integer('stored_capacity')->default(0); //Kapasitas Tersimpan
            $table->longText('path_qrcode')->nullable();

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
        Schema::dropIfExists('lokasi_penyimpanan');
    }
}
