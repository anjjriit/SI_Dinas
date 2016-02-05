<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatedByColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting', function (Blueprint $table) {
            $table->string('updated_by')->nullable();
        });
        Schema::table('jenis_biaya_pengeluaran_standard', function (Blueprint $table) {
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting', function (Blueprint $table) {
            $table->dropColumn('updated_by');
        });
        Schema::table('jenis_biaya_pengeluaran_standard', function (Blueprint $table) {
            $table->dropColumn('updated_by');
        });
    }
}
