<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyStatusOnLpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lpd', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('lpd', function (Blueprint $table) {
            $table->enum('status', ['DRAFT', 'SUBMIT', 'DECLINE', 'PROCESS PAYMENT', 'TAKE PAYMENT', 'RECALL', 'BACK TO INITIATOR', 'PAID', 'PAYMENT RECEIVED'])->after('reimburse');
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
