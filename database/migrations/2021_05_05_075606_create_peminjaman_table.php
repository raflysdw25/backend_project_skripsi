<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nim_mahasiswa')->nullable();
            $table->string('nip_staff')->nullable();
            $table->string('nip_staff_in_charge')->nullable();
            $table->string('pjm_purpose');
            $table->unsignedInteger('ruangan_id');
            $table->date('expected_return_date');
            $table->date('real_return_date')->nullable();
            $table->enum('pjm_type', ['long', 'short']);
            $table->integer('pjm_status'); //1: Butuh Persetujuan, 2: Berhasil, 3: Ditolak, 4: Belum Kembali, 5: Selesai
            $table->longText('pjm_notes')->nullable();

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
        Schema::dropIfExists('peminjaman');
    }
}
