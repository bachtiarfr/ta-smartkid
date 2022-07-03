<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ortu_id');
            $table->string('nisn');
            $table->enum('jk' , ['L' , 'P']);
            $table->enum('jurusan' , ['Teknik Kendaraan Ringan' , 'Teknik Permesinan' , 'Teknik Komputer Jaringan' , 'Teknik Kimia Industri' ]);
            $table->enum('kelas' , ['X' , 'XI' , 'XII']);
            $table->string('berkas_prestasi' , 255 );
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('siswas');
    }
}
