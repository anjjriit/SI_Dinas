<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpd', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('pegawai')->onUpdate('cascade');
            $table->enum('kategori', ['trip', 'non_trip']);
            $table->enum('jenis_perjalanan', ['dalam_kota', 'luar_kota']);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('kode_kota_asal')->unsigned();
            $table->foreign('kode_kota_asal')->references('kode')->on('kota')->onUpdate('cascade');
            $table->integer('kode_kota_tujuan')->unsigned();
            $table->foreign('kode_kota_tujuan')->references('kode')->on('kota')->onUpdate('cascade');
            $table->string('sarana_penginapan');
            $table->enum('status', ['DRAFT', 'SUBMIT', 'RECALL', 'APPROVED', 'DECLINE', 'BACK TO INITIATOR']);
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
        Schema::drop('rpd');
    }
}
