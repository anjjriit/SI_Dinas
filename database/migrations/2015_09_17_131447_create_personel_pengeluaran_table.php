<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonelPengeluaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personel_pengeluaran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pengeluaran')->unsigned();
            $table->foreign('id_pengeluaran')->references('id')->on('pengeluaran')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('personel_pengeluaran');
    }
}
