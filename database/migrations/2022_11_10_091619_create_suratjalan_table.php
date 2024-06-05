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
        Schema::create('suratjalan', function (Blueprint $table) {
            $table->string('kode','30')->primary();
            $table->date('tanggal');
            $table->string('tipe','15');
            $table->string('so','25')->nullable();
            $table->date('tgl_kirim')->nullable();
            $table->string('kota','20')->nullable();
            $table->string('konsumen','15')->nullable();
            $table->string('alamat','100')->nullable();
            $table->date('tgl_diterima')->nullable();
            $table->string('nopol','10')->nullable();
            $table->string('ekspedisi','30')->nullable();
            $table->string('no_resi','30')->nullable();
            $table->string('keterangan','100');
            $table->string('status','50');
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
        Schema::dropIfExists('suratjalan');
    }
};
