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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('np2')->unique();
            $table->date('max_sp2')->nullable();
            $table->date('max_permdok')->nullable();
            $table->date('max_pengujian1')->nullable();
            $table->date('max_pengujian2')->nullable();
            $table->date('max_sphp')->nullable();
            $table->date('max_lhp')->nullable();
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
        Schema::dropIfExists('tagihans');
    }
};
