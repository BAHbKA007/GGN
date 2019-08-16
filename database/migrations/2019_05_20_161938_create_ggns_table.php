<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGgnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ggns', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->index()->primary();
            $table->unsignedBigInteger('ggn')->index();
            $table->string('erzeuger')->nullable();
            $table->string('user_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ggns');
    }
}
