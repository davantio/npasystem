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
        //
        Schema::create('lapmarketing', function (Blueprint $table) {
            $table->id('kode')->autoIncrement();
            $table->string('marketing',15);
            $table->date('tanggal');
            $table->date('tanggal_akhir');
            $table->longText('laporan');
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
        //
        Schema::dropIfExists('lapmarketing');
    }
};
