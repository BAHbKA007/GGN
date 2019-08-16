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
            $table->unsignedBigInteger('groupggn')->nullable();
            $table->string('erzeuger')->nullable();
            $table->string('country')->nullable();
            $table->string('company_type')->nullable();
            $table->string('grasp_status')->nullable();
            $table->date('grasp_valid_to')->nullable();
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
