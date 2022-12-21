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
        Schema::create('tunggakans', function (Blueprint $table) {
            $table->id();
            $table->string('np2')->unique();
            $table->date('tgl_np2');
            $table->string('up2');
            $table->string('npwp');
            $table->string('nama_wp');
            $table->string('kode_rik');
            $table->string('periode_1');
            $table->string('periode_2');
            $table->string('masa_pajak');
            $table->string('tahun_pajak');
            $table->string('sp2')->nullable();
            $table->date('tgl_sp2')->nullable();
            $table->date('tgl_sppl')->nullable();
            $table->string('sphp')->nullable();
            $table->date('tgl_sphp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tunggakans');
    }
};
