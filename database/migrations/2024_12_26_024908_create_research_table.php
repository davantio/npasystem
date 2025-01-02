<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research', function (Blueprint $table) {
            $table->id('id_research');
            $table->string('nama_produk');
            $table->text('bahan_baku');
            $table->text('proses_produksi');
            $table->date('tanggal_rilis');
            $table->string('foto_produk');
            $table->timestamps();
        });

        Schema::create('detail_berkas', function (Blueprint $table) {
            $table->id('id_berkas');
            $table->unsignedBigInteger('id_research');
            $table->string('file');
            $table->timestamps();

            $table->foreign('id_research')->references('id_research')->on('research')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_berkas');
        Schema::dropIfExists('research');
    }
};
