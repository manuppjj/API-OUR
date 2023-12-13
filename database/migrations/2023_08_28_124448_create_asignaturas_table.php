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
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->unsignedBigInteger('maestro_id');
            $table->foreign('maestro_id')
            ->references('id')
            ->on('maestros');

            $table->unsignedBigInteger('degree_id');
             $table->foreign('degree_id')
             ->references('id')
             ->on('degrees');
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
        Schema::dropIfExists('asignaturas');
    }
};
