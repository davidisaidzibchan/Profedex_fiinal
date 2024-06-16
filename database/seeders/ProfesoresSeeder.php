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
        // Crea 10 profesores utilizando el factory de la clase Profesor
        Profesor::factory()->count(10)->create();

        // Obtiene los primeros 5 usuarios de la base de datos
        $users = User::all()->take(5);

        // Obtiene los primeros 2 profesores creados
        $professors = Profesor::all()->take(2);

        // Asigna "me gusta" a los primeros 2 profesores por algunos usuarios
        foreach ($users as $user) {
            foreach ($professors as $professor) {
                // Registra el "me gusta" del usuario por el profesor en la tabla profesor_like
                DB::table('profesor_like')->insert([
                    'id_usuario' => $user->id,
                    'id_profesor' => $professor->id,
                    'created_at' => now(), // Establece la fecha y hora actual como fecha de creación
                    'updated_at' => now(), // Establece la fecha y hora actual como fecha de actualización
                ]);
            }
        }
    }
}
