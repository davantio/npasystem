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
        Schema::create('omset_marketing', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('jns_marketing',10);
            $table->string('kd_marketing',20);
            $table->date('bulan');
            $table->float('omset');
            $table->string('keterangan');
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
        Schema::dropIfExists('omset_marketing');
    }
};
