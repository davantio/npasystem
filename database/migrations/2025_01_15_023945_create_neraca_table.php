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
        Schema::create('neraca', function (Blueprint $table) {
            $table->string('kode')->primary();
            $table->string('akun');
            $table->string('perusahaan');
            $table->string('jumlah');
            $table->string('debit');
            $table->string('kredit');
            $table->date('tanggal');
            $table->string('status');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('neraca');
    }
};
