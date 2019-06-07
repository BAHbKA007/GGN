<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammkundeartikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmkundeartikels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prokun_id');
            $table->unsignedBigInteger('art_id');
            $table->timestamps();

            $table->foreign('prokun_id')
                ->references('id')->on('programmkundes')
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
        Schema::dropIfExists('programmkundeartikels');
    }
}
