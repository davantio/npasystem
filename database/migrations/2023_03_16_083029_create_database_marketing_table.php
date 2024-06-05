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
        Schema::create('database_marketing', function (Blueprint $table) {
            $table->id('kode')->autoIncrement();
            $table->string('kategori',30);
            $table->string('nama_perusahaan',100);
            $table->string('alamat_kantor')->nullable();
            $table->string('alamat_pabrik')->nullable();
            $table->string('telp_wa',30)->nullable();
            $table->string('email')->nullable();
            $table->string('orang_dalam')->nullable();
            $table->string('medsos')->nullable();
            $table->string('kebutuhan')->nullable();
            $table->string('PIC',20)->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status',20);
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
        Schema::dropIfExists('database_marketing');
    }
};
