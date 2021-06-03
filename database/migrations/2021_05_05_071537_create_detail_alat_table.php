<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_alat', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('alat_id');
            $table->string('barcode_alat')->unique();
            $table->integer('condition_status'); // 1: Pending, 2: Baik, 3: Rusak, 4: Habis, 5: Diperbaiki, 6: Apkir.
            $table->integer('available_status'); // 1: Pending, 2: Tersedia, 3: Tidak Tersedia
            $table->integer('lokasi_id');

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
        Schema::dropIfExists('detail_alat');
    }
}
