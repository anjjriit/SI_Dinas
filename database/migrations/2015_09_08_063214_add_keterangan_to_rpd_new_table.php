<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeteranganToRpdNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rpd', function (Blueprint $table) {
            $table->string('keterangan')->after('sarana_penginapan')->nullable();
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
            $table->dropColumn('keterangan');
        });
    }
}
