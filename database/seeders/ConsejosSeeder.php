<?php

namespace Database\Seeders;

use App\Models\Consejo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsejosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Consejo::factory()->count(20)->create()->each(function ($consejo) {
            // Para cada consejo creado, crea un registro en la tabla favoritos para un usuario aleatorio
            DB::table('favoritos')->insert([
                'id_usuario' => rand(1, User::count()), // Asigna un ID de usuario aleatorio
                'id_consejo' => $consejo->id, // Utiliza el ID del consejo recién creado
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
