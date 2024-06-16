<?php

namespace Database\Seeders;

use App\Models\Materia;
use App\Models\Profesor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea 10 materias utilizando el factory de la clase Materia
        Materia::factory()->count(10)->create();

        // Obtiene todos los profesores disponibles
        $profesores = Profesor::all();

        // Recorre las materias y asocia profesores a cada una
        Materia::all()->each(function ($materia) use ($profesores) {
            // Asocia entre 1 y 3 profesores al azar con la materia
            $profesoresAsociados = $profesores->random(rand(1, 3));
            // Asocia los profesores seleccionados con la materia actual
            $materia->profesores()->attach($profesoresAsociados->pluck('id'));
        });
    }
}
