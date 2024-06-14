<?php

namespace Database\Seeders;

use App\Models\Materia;
use App\Models\Profesor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profesor::factory()->count(10)->create();

        $users = User::all()->take(5);

        // Obtener los primeros dos profesores creados
        $professors = Profesor::all()->take(2);

        // Dar "me gusta" a los primeros dos profesores por algunos usuarios
        foreach ($users as $user) {
            foreach ($professors as $professor) {
                DB::table('profesor_like')->insert([
                    'id_usuario' => $user->id,
                    'id_profesor' => $professor->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
