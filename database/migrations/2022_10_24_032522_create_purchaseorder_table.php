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
        Schema::create('purchaseorder', function (Blueprint $table) {
            $table->string('kode','20')->primary();
            $table->date('tanggal');
            $table->string('jenis','15');
            $table->string('supplier','10');
            $table->string('pembayaran','15');
            $table->string('spk','25')->nullable();
            $table->dateTime('time_delivery')->nullable();
            $table->string('term_payment','30')->nullable();
            $table->integer('vat');
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
        Schema::dropIfExists('purchaseorder');
    }
};
