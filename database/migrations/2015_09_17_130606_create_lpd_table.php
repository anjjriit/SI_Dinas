<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lpd', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->integer('id_rpd')->unsigned();
            $table->foreign('id_rpd')->references('id')->on('rpd')->onUpdate('cascade');
            $table->date('tanggal_laporan');
            $table->integer('total_pengeluaran');
            $table->boolean('reimburse');
            $table->enum('status', ['DRAFT', 'SUBMIT', 'DECLINE', 'PROCESS_PAYMENT', 'TAKE PAYMENT', 'RECALL', 'BACK TO INITIATOR', 'PAID', 'PAYMENT RECEIVED']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lpd');
    }
}
