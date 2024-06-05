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
        Schema::create('barang', function (Blueprint $table) {
            
            $table->string('kode','10')->primary();
            $table->string('nama');
            $table->string('jenis','20');
            $table->string('satuan','20');
            $table->string('packing','20');
            $table->string('perusahaan','50');
            $table->string('kd_persediaan','7');
            $table->string('kd_persediaan_hpp','7');
            $table->string('kd_pendapatan','7');
            $table->string('kd_persediaan_intransit','7');
            $table->string('keterangan','100');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
