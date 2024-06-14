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
        Schema::create('consejos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('consejo');
            $table->string('semestre')->nullable();
            $table->unsignedBigInteger('id_materia')->nullable();
            $table->unsignedBigInteger('id_profesor')->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->boolean('anonimo')->default(false);
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_materia')->references('id')->on('materias')->onDelete('cascade')->nullable();
            $table->foreign('id_profesor')->references('id')->on('profesores')->onDelete('cascade')->nullable();
            $table->json('etiquetas')->nullable();
            $table->boolean('estado')->default(true);
            $table->unsignedInteger('like')->default(0);
            $table->unsignedInteger('dislike')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consejos');
    }
};
