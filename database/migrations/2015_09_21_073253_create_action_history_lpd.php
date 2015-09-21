<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionHistoryLpd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_history_lpd', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_lpd')->unsigned();
            $table->foreign('id_lpd')->references('id')->on('lpd')->onUpdate('cascade');
            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('pegawai')->onUpdate('cascade');
            $table->enum('action', ['DRAFT', 'SUBMIT', 'RECALL', 'APPROVED', 'DECLINE', 'BACK TO INITIATOR', 'PROCESS PAYMENT', 'TAKE PAYMENT', 'PAID', 'PAYMENT RECEIVED']);
            $table->text('comment')->nullable();
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
        Schema::drop('action_history_lpd');
    }
}
