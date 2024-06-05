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
        Schema::create('detail_kas', function (Blueprint $table) {
            $table->string('kode')->primary();
            $table->string('kode_kas');
            $table->string('kode_transaksi','30')->nullable();
            $table->string('kode_brg')->nullable();
            $table->double('vat');
            $table->float('harga',15,8);
            $table->float('qty',15,8);
            $table->float('total',15,8);
            $table->string('keterangan','255')->nullable();
            $table->string('debit',7);
            $table->string('kredit',7);
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
        Schema::dropIfExists('detail_kas');
    }
};
