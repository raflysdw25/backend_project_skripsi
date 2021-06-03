<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat', function (Blueprint $table) {
            $table->id();
            $table->string('alat_name');
            $table->unsignedInteger('jenis_alat_id');
            $table->longText('alat_specs')->nullable();
            $table->unsignedInteger('asal_pengadaan_id');
            $table->string('alat_year'); //Tahun Pengadaan
            $table->unsignedInteger('supplier_id')->nullable();
            $table->integer('alat_total');
            

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
        Schema::dropIfExists('alat');
    }
}
