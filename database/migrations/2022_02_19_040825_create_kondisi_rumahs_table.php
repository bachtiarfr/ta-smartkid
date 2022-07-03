<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKondisiRumahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kondisi_rumahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('ortu_id');
            $table->enum('status_rumah' , ['pribadi' , 'kontrak' , 'milik orangtua' ]);
            $table->enum('level_bangunan' , ['permanen' , 'non-permanen' ]);
            $table->string('berkas_surat_pajak' , 255 );
            $table->string('photo' , 255 );
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ortu_id')->references('id')->on('orang_tuas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kondisi_rumahs');
    }
}
