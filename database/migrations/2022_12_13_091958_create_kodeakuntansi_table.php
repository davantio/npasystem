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
        Schema::create('kodeakuntansi', function (Blueprint $table) {
            $table->double('kode')->primary();
            $table->string('nama_perkiraan',50);
            $table->string('jenis',1);
            $table->double('no_group');
            $table->double('nomor');
            $table->double('no_urut_group');
            $table->double('no_urut_laporan');
            $table->string('jenis_laporan',30);
            $table->string('group_laporan',30)->nullable();
            $table->string('keterangan',100)->nullable();
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
        Schema::dropIfExists('kodeakuntansi');
    }
};
