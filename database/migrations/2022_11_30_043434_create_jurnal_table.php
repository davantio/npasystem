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
        Schema::create('jurnal', function (Blueprint $table) {
            $table->string('kode_transaksi',30)->primary();
            $table->string('akun_debit',10)->nullable();
            $table->string('akun_kredit',10)->nullable();
            $table->string('kode_brg',25)->nullable();
            $table->string('nama_brg',50)->nullable();
            $table->string('nama_request',50)->nullable();
            $table->string('kode_gdg',15)->nullable();
            $table->string('nama_gdg',50)->nullable();
            $table->string('kode_marketing',15)->nullable();
            $table->string('nama_marketing',50)->nullable();
            $table->string('kode_rekanan',25)->nullable();
            $table->string('nama_rekanan',50)->nullable();
            $table->float('qty_debit',15,8)->nullable();
            $table->float('harga_debit',15,8)->nullable();
            $table->float('jumlah_debit',15,8)->nullable();
            $table->float('qty_kredit',15,8)->nullable();
            $table->float('harga_kredit',15,8)->nullable();
            $table->float('jumlah_kredit',15,8)->nullable();
            $table->string('satuan',15)->nullable();
            $table->double('vat')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status',30);
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
        Schema::dropIfExists('jurnal');
    }
};
