<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammkundesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmkundes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pro_id');
            $table->unsignedBigInteger('kun_id');
            $table->timestamps();

            $table->foreign('pro_id')
                ->references('id')->on('programms')
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
        Schema::dropIfExists('programmkundes');
    }
}
