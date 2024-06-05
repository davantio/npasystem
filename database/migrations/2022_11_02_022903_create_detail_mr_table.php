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
        Schema::create('detail_mr', function (Blueprint $table) {
            $table->id('kode')->autoIncrement();
            $table->string('kode_mr','20');
            $table->string('kode_brg','10');
            $table->string('kode_gdg','10');
            $table->float('harga',15,8);
            $table->float('dikirim',15,8);
            $table->float('diakui',15,8);
            $table->float('diterima',15,8);
            $table->float('dpp',15,8);
            $table->float('vat');
            $table->float('total',15,8);
            $table->string('keterangan','100');
            $table->string('kode_debit','5')->nullable();
            $table->string('kode_kredit','5')->nullable();
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
        Schema::dropIfExists('detail_mr');
    }
};
