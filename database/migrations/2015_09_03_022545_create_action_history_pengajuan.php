<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionHistoryPengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_history_pengajuan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_rpd')->unsigned();
            $table->foreign('id_rpd')->references('id')->on('rpd')->onUpdate('cascade');
            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('pegawai')->onUpdate('cascade');
            $table->enum('action', ['DRAFT', 'SUBMIT', 'RECALL', 'APPROVED', 'DECLINE', 'BACK TO INITIATOR']);
            $table->text('comment');
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
        Schema::drop('action_history_pengajuan');
    }
}
