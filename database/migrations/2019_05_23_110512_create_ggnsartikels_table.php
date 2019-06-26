<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGgnsArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ggnsartikels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ggn');
            $table->unsignedBigInteger('artikel_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('artikel_id')
            ->references('id')->on('artikels')
            ->onDelete('cascade');
            
            $table->foreign('ggn')
            ->references('ggn')->on('ggns')
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
        Schema::dropIfExists('ggnsartikels');
    }
}