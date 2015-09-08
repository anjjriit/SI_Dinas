<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullableFieldOnRpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rpd', function (Blueprint $table) {
            $table->dropForeign('rpd_nik_foreign');
            $table->dropForeign('rpd_kode_kota_asal_foreign');
            $table->dropForeign('rpd_kode_kota_tujuan_foreign');
        });

        Schema::table('action_history_pengajuan', function (Blueprint $table) {
            $table->dropForeign('action_history_pengajuan_id_rpd_foreign');
        });

        Schema::table('sarana_transportasi', function (Blueprint $table) {
            $table->dropForeign('sarana_transportasi_id_rpd_foreign');
        });

        Schema::table('peserta', function (Blueprint $table) {
            $table->dropForeign('peserta_id_rpd_foreign');
        });

        Schema::drop('rpd');

        Schema::create('rpd', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('pegawai')->onUpdate('cascade');
            $table->enum('kategori', ['trip', 'non_trip'])->nullable();
            $table->enum('jenis_perjalanan', ['dalam_kota', 'luar_kota'])->nullable;
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('kode_kota_asal')->unsigned()->nullable();
            $table->foreign('kode_kota_asal')->references('kode')->on('kota')->onUpdate('cascade');
            $table->integer('kode_kota_tujuan')->unsigned()->nullable();
            $table->foreign('kode_kota_tujuan')->references('kode')->on('kota')->onUpdate('cascade');
            $table->enum('sarana_penginapan', ['kost', 'hotel', 'guest_house'])->nullable();
            $table->enum('status', ['DRAFT', 'SUBMIT', 'RECALL', 'APPROVED', 'DECLINE', 'BACK TO INITIATOR']);
            $table->timestamps();
        });

        Schema::table('action_history_pengajuan', function (Blueprint $table) {
            $table->foreign('id_rpd')->references('id')->on('rpd')->onUpdate('cascade');
        });

        Schema::table('sarana_transportasi', function (Blueprint $table) {
            $table->foreign('id_rpd')->references('id')->on('rpd')->onUpdate('cascade');
        });

        Schema::table('peserta', function (Blueprint $table) {
            $table->foreign('id_rpd')->references('id')->on('rpd')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rpd', function (Blueprint $table) {
            //
        });
    }
}
