<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZaehlungpositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zaehlungpositions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zaehlung_id');
            $table->unsignedBigInteger('kunde_id');
            $table->unsignedBigInteger('art_id');
            $table->unsignedBigInteger('ggn');
            $table->unsignedBigInteger('menge');
            $table->string('user')->nullable();
            $table->timestamps();
            $table->foreign('zaehlung_id')
                ->references('id')->on('zaehlungs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zaehlungpositions');
    }
}
