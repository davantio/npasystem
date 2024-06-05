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
        Schema::create('invoice', function (Blueprint $table) {
            $table->string('kode',25)->primary();
            $table->date('tanggal');
            $table->string('kode_so',25);
            $table->string('kode_sj',25);
            $table->string('kode_bank',2);
            $table->string('po_req',50)->nullable();
            $table->double('vat');
            $table->date('tgl_tempo')->nullable();
            $table->float('DP',15,8);
            $table->string('keterangan','100')->nullable();
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
        Schema::dropIfExists('invoice');
    }
};
