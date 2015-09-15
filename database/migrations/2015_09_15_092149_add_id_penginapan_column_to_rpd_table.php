<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdPenginapanColumnToRpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rpd', function (Blueprint $table) {
            $table->dropColumn('sarana_penginapan');
            $table->integer('id_penginapan')->unsigned()->after('kode_kota_tujuan');
            $table->foreign('id_penginapan')->references('id')->on('penginapan')->onUpdate('cascade');

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
            $table->dropForeign('rpd_id_penginapan_foreign');
            $table->dropColumn('id_penginapan');
            $table->enum('sarana_penginapan', ['kost', 'hotel', 'guest_house']);
        });
    }
}
