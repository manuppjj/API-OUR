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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('gmail');
            $table->string('password');
            // $table->foreignId('role_id')->constrained();
            // $table->unsignedBigInteger('role_id')->unique();
            $table->unsignedBigInteger('role_id')->constrained();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles');

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
        Schema::dropIfExists('users');
    }
};


