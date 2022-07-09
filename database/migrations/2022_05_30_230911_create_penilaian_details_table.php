<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penilaian_id');
            // kondisi rumah
            $table->unsignedBigInteger('rumah_id');
            $table->integer('value_rumah');
            // assets
            $table->unsignedBigInteger('assets_id');
            $table->integer('value_assets');
            // ternak
            // $table->unsignedBigInteger('ternak_id');
            // $table->integer('value_ternak');

            $table->timestamps();

            $table->foreign('penilaian_id')->references('id')->on('penilaians')->onDelete('cascade');
            $table->foreign('rumah_id')->references('id')->on('rumahs')->onDelete('cascade');
            $table->foreign('assets_id')->references('id')->on('assets')->onDelete('cascade');
            // $table->foreign('ternak_id')->references('id')->on('ternaks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian_details');
    }
}
