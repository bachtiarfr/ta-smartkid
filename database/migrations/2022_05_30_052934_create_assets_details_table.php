<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assets_id');
            $table->string('key');
            $table->unsignedtinyInteger('value');
            $table->timestamps();

            $table->foreign('assets_id')->references('id')->on('assets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets_details');
    }
}
