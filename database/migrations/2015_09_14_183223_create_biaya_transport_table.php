<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiayaTransportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biaya_transport', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_transportasi')->unsigned();
            $table->foreign('id_transportasi')->references('id')->on('transportasi')->onUpdate('cascade');

            $table->integer('id_kota_asal')->unsigned();
            $table->foreign('id_kota_asal')->references('kode')->on('kota')->onUpdate('cascade');

            $table->integer('id_kota_tujuan')->unsigned();
            $table->foreign('id_kota_tujuan')->references('kode')->on('kota')->onUpdate('cascade');

            $table->integer('harga');

            $table->timestamps();
            $table->timestamp('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('biaya_transport');
    }
}
