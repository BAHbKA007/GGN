<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoapArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soap_artikels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ggn_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->string('product_status');
            $table->date('valid_to_current')->nullable();
            $table->date('valid_to_next')->nullable();
            $table->timestamps();

            $table->foreign('ggn_id')
                ->references('id')->on('ggns')
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
        Schema::dropIfExists('soap_artikels');
    }
}
