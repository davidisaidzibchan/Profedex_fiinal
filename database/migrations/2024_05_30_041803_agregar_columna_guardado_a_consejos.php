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
        Schema::table('consejos', function (Blueprint $table) {
            $table->boolean('guardado')->default(false); // Agregar la columna guardado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consejos', function (Blueprint $table) {
            $table->dropColumn('guardado'); // Eliminar la columna guardado
        });
    }
};
