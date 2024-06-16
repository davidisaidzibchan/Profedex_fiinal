<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materia_profesores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_profesor');
            $table->unsignedBigInteger('id_materia');
            $table->foreign('id_profesor')->references('id')->on('profesores')->onDelete('cascade');
            $table->foreign('id_materia')->references('id')->on('materias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia_profesores');
    }
};
