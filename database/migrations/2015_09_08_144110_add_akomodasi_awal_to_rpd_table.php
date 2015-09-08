<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAkomodasiAwalToRpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rpd', function (Blueprint $table) {
            $table->integer('akomodasi_awal')->after('sarana_penginapan')->default(0);
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
            $table->dropColumn('akomodasi_awal');
        });
    }
}
