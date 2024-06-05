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
        Schema::create('salesorder', function (Blueprint $table) {
            $table->string('kode','30')->primary();
            $table->date('tanggal');
            $table->string('jenis','15');
            $table->string('konsumen','10');
            $table->string('pembayaran','15');
            $table->string('marketing','15');
            $table->string('no_po','30')->nullable();
            $table->date('tgl_diterima')->nullable();
            $table->string('term_payment','30')->nullable();
            $table->integer('vat');
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
        Schema::dropIfExists('salesorder');
    }
};
