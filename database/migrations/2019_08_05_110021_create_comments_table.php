<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zaehlung_id');
            $table->unsignedBigInteger('kunde_id');
            $table->text('comment')->nullable();
            $table->boolean('erledigt')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_aenderung_id')->nullable();
            $table->timestamps();

            $table->foreign('zaehlung_id')
                ->references('id')->on('zaehlungs')
                ->onDelete('cascade');

            $table->foreign('kunde_id')
                ->references('id')->on('kundes')
                ->onDelete('cascade');
            
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
                
            $table->foreign('user_aenderung_id')
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('comments');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
