<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransCuti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_cuti', function (Blueprint $table) {
            $table->increments('id_cuti');
            $table->string('nomor_induk', 7);
            $table->date('tanggal_cuti');
            $table->tinyInteger('lama_cuti');
            $table->text('keterangan');
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
        Schema::dropIfExists('trans_cuti');
    }
}
