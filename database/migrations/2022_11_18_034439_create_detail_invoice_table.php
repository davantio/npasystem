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
        Schema::create('detail_invoice', function (Blueprint $table) {
            $table->id('kode');
            $table->string('kode_inv',25);
            $table->date('tgl_kirim');
            $table->date('tgl_terima');
            $table->string('kode_gdg',10);
            $table->string('kode_brg',15);
            $table->float('diakui',15,8);
            $table->float('dikirim',15,8);
            $table->float('diterima',15,8);
            $table->string('nama_request',50)->nullable();
            $table->float('harga_jual',15,8);
            $table->float('dpp',15,8);
            $table->float('jumlah',15,8);
            $table->string('keterangan',100)->nullable();
            $table->string('debit',10);
            $table->string('kredit',10);
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
        Schema::dropIfExists('detail_invoice');
    }
};
