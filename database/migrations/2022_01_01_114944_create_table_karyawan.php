<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('karyawan');
        Schema::create('karyawan', function (Blueprint $table) {
            $table->string('nomor_induk', 7)->primary();
            $table->string('nama');
            $table->string('alamat');
            $table->date('tanggal_lahir');
            $table->date('tanggal_bergabung');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
}
