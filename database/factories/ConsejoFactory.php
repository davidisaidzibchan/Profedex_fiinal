<?php

namespace Database\Factories;

use App\Livewire\Profesor;
use App\Models\Consejo;
use App\Models\Materia;
use App\Models\Profesor as ModelsProfesor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consejo>
 */
class ConsejoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Consejo::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $materiaIds = Materia::pluck('id')->toArray();
        $profesorIds = ModelsProfesor::pluck('id')->toArray();

        return [
            'titulo' => $this->faker->sentence,
            'consejo' => $this->faker->paragraph,
            'semestre' => $this->faker->word,
            'id_materia' => $this->faker->randomElement($materiaIds),
            'id_profesor' => $this->faker->randomElement($profesorIds),
            'id_usuario' => $this->faker->randomElement($userIds),
            'anonimo' => false,
            'etiquetas' =>json_encode(['#tag1', '#tag2', '#tag3']),
            'estado' => true,
            'like' => $this->faker->numberBetween(0, 1000),
            'dislike' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
