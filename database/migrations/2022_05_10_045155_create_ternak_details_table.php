<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTernakDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ternak_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ternak_id');
            $table->string('key');
            $table->unsignedtinyInteger('value');
            $table->timestamps();

            $table->foreign('ternak_id')->references('id')->on('ternaks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ternak_details');
    }
}
