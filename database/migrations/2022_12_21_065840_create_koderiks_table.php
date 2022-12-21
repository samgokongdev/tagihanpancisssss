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
        Schema::create('koderiks', function (Blueprint $table) {
            $table->string('kode_rik')->primary();
            $table->integer('cpt')->nullable();
            $table->integer('ideal')->nullable();
            $table->integer('lwt')->nullable();
            $table->float('k_t')->nullable();
            $table->float('kriteria')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('koderiks');
    }
};
