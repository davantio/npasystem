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
        Schema::create('rekanan', function (Blueprint $table) {
            $table->string('kode','10')->primary();
            $table->string('mitra','10');
            $table->string('nama','30');
            $table->string('wa','12');
            $table->string('nama_perusahaan','50')->nullable();
            $table->string('telp','12')->nullable();
            $table->string('bank1','20')->nullable();
            $table->string('bank2','20')->nullable();
            $table->string('email','30')->nullable();
            $table->string('marketing','10')->nullable();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('rekanan');
    }
};
