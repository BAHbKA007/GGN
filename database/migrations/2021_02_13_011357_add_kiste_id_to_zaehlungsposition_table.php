<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKisteIdToZaehlungspositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zaehlungpositions', function (Blueprint $table) {
            $table->unsignedBigInteger('kiste_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kistes', function($table) {
            $table->dropColumn('kiste_id');
        });
    }
}
