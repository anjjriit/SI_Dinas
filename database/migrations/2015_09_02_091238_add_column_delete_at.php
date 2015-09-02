<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDeleteAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pegawai', function (Blueprint $table){
            $table->softDeletes();
        });

        Schema::table('kota', function (Blueprint $table){
            $table->softDeletes();
        });

        Schema::table('prospek', function (Blueprint $table){
            $table->softDeletes();
        });

        Schema::table('project', function (Blueprint $table){
            $table->softDeletes();
        });

        Schema::table('pelatihan', function (Blueprint $table){
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
        //
    }
}
