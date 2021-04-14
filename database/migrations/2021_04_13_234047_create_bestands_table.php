<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBestandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bestands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('art_id');
            $table->unsignedMediumInteger('menge');
            $table->date('datum');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
            $table->foreign('art_id')
                ->references('id')->on('artikels')
                ->onDelete('cascade');
            
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('bestands');
    }
}
