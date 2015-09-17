<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNikColumnToLpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lpd', function (Blueprint $table) {
            $table->string('nik')->after('id_rpd')->nullable();
            $table->dropColumn('deleted_at');
        });

        Schema::table('lpd', function (Blueprint $table) {
            $table->foreign('nik')->references('nik')->on('pegawai')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lpd', function (Blueprint $table) {
            //
        });
    }
}
