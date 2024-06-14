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
        
        Schema::create('votos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_consejo');
            $table->unsignedBigInteger('id_usuario');
            $table->enum('decision', ['aceptar', 'declinar']); // Columna para guardar la decisión
            $table->timestamps();
        
            // Definir claves foráneas
            $table->foreign('id_consejo')->references('id')->on('consejos')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votos');
    }
};
