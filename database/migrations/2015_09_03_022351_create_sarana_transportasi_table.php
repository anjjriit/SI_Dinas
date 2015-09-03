<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaranaTransportasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sarana_transportasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_rpd')->unsigned();
            $table->foreign('id_rpd')->references('id')->on('rpd')->onUpdate('cascade');

            $table->string('nama_transportasi');
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
        Schema::drop('sarana_transportasi');
    }
}
