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
        Materia::factory()->count(10)->create();

        $profesores = Profesor::all();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        // Recorre las materias y asocia profesores a cada una
        Materia::all()->each(function ($materia) use ($profesores) {
            // Asocia profesores al azar con la materia
            $profesoresAsociados = $profesores->random(rand(1, 3));
            $materia->profesores()->attach($profesoresAsociados->pluck('id'));
        });
    }
}
