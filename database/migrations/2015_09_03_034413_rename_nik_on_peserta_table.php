<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameNikOnPesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peserta', function (Blueprint $table) {
            $table->dropColumn('nik');
            $table->string('nik_peserta')->after('id_rpd');
            $table->foreign('nik_peserta')->references('nik')->on('pegawai')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peserta', function (Blueprint $table) {
            $table->dropForeign('peserta_nik_peserta_foreign');
            $table->dropColumn('nik_peserta');
            $table->string('nik');
        });
    }
}
