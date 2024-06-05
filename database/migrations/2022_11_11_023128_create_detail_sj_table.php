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
        Schema::create('detail_sj', function (Blueprint $table) {
            $table->id('kode')->autoIncrement();
            $table->string('kode_sj','25');
            $table->string('kode_gdg','15');
            $table->string('kode_brg','15');
            $table->string('nama_request','50')->nullable();
            $table->float('diakui',15,8);
            $table->float('dikirim',15,8);
            $table->float('diterima',15,8);
            $table->string('keterangan','100')->nullable();
            $table->string('debit','5');
            $table->string('kredit','5');
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
        Schema::dropIfExists('detail_sj');
    }
};
