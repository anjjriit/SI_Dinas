<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_rpd')->unsigned();
            $table->foreign('id_rpd')->references('id')->on('rpd')->onUpdate('cascade');
            $table->string('nik');
            $table->enum('jenis_kegiatan', ['project', 'prospek', 'pelatihan']);
            $table->integer('kode_kegiatan')->unsigned();
            $table->enum('kegiatan', ['UAT', 'REQUIREMENT_GATHERING', 'REVIEW', 'TRAINING_USER', '-']);
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
        Schema::drop('peserta');
    }
}
