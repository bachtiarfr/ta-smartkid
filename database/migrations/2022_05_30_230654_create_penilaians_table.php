<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            // ambil data profil siswa
            $table->unsignedBigInteger('siswa_id');
            // data penghasilan
            $table->unsignedBigInteger('penghasilan_id');
            // data tanggungan
            $table->unsignedBigInteger('tanggungan_id');
            // kepemilikan asuransi kesehatan
            $table->unsignedBigInteger('asuransi_id');
            //nilai gaji
            $table->float('c1');
            //nilai hasil terhadap kondisi rumah
            $table->float('c2');
            //nilai hasil kepemilikan asset
            $table->float('c3');
            //nilai tanggungan
            $table->float('c4');
            //nilai asuransi
            $table->float('c5');
            
            $table->timestamps();

            // $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            // $table->foreign('penghasilan_id')->references('id')->on('penghasilans')->onDelete('cascade');
            // $table->foreign('tanggungan_id')->references('id')->on('tanggungan_anaks')->onDelete('cascade');
            // $table->foreign('asuransi_id')->references('id')->on('asuransis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaians');
    }
}
