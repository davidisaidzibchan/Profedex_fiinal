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
        Schema::create('profesores', function (Blueprint $table) {
            $table->id();
            $table->string('nivel_edu');
            $table->string('nombre');
            $table->text('descripcion');
            $table->integer('kills');
            $table->integer('xp');
            $table->string('dificultad');
            $table->unsignedInteger('like')->default(0);
            $table->string('peligro');
            $table->json('atributos');
            $table->text('curiosidades');
            $table->string('horario');
            $table->string('categoria');
            $table->text('habilidades');
            $table->string('semestres');
            $table->json('clases');
            $table->json('imagen');
            $table->string('tema');
            $table->text('tipo');
            $table->string('correo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesores');
    }
};
