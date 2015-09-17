<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengeluaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_lpd')->unsigned();
            $table->foreign('id_lpd')->references('id')->on('lpd')->onUpdate('cascade');
            $table->date('tanggal');
            $table->integer('id_tipe')->unsigned()->nullable();
            $table->string('keterangan');
            $table->string('struk');
            $table->integer('biaya');
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
        Schema::drop('pengeluaran');
    }
}
