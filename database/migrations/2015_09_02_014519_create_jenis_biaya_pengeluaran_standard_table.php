<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisBiayaPengeluaranStandardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_biaya_pengeluaran_standard', function (Blueprint $table) {
            $table->increments('kode');
            $table->string('nama_jenis');
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
        Schema::drop('jenis_biaya_pengeluaran_standard');
    }
}
