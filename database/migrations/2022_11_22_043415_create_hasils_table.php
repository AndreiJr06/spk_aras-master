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
        Schema::create('hasil', function (Blueprint $table) {
            $table->id();
            $table->double('si', 15, 5)->nullable();
            $table->double('ki', 15, 5)->nullable();
            $table->integer('rank')->unsigned()->nullable();
            $table->unsignedBigInteger('id_atlet');
            $table->unsignedBigInteger('id_periode');
            $table->foreign('id_atlet')->references('id')->on('data_atlet')->onDelete('cascade');
            $table->foreign('id_periode')->references('id')->on('periode')->onDelete('cascade');
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
        Schema::dropIfExists('hasil');
    }
};
