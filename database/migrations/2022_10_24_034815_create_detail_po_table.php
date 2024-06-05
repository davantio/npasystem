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
        Schema::create('detail_po', function (Blueprint $table) {
            $table->id('kode');
            $table->string('kode_po','20');
            $table->string('kode_brg','10');
            $table->float('harga',15,8);
            $table->float('qty',15,8);
            $table->string('keterangan','100');
            $table->float('jumlah',15,8);
            $table->float('rate')->nullable();
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
        Schema::dropIfExists('detail_po');
    }
};
