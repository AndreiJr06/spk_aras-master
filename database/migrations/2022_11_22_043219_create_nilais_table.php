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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_atlet');
            $table->foreign('id_atlet')->references('id')->on('data_atlet')->onDelete('cascade');
            $table->unsignedBigInteger('id_kriteria');
            $table->foreign('id_kriteria')->references('id')->on('kriteria')->onDelete('cascade');
            $table->unsignedBigInteger('id_periode');
            $table->foreign('id_periode')->references('id')->on('periode')->onDelete('cascade');
            $table->double('nilai', 15, 6)->nullable();
            $table->double('normalisasi_kriteria', 15, 6)->nullable();
            $table->double('normalisasi_bobot', 15, 6)->nullable();
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
        Schema::dropIfExists('nilai');
    }
};
