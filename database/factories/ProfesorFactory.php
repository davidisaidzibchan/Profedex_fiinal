<?php

namespace Database\Factories;

use App\Models\Profesor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profesor>
 */
class ProfesorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Profesor::class;


    public function definition()
    {
        $habilidades = implode(', ', $this->faker->words(5));
        $cantidadNumeros = rand(1, 9); // Genera un número aleatorio entre 1 y 9
        $numeros = range(1, 9); // Genera un array con números del 1 al 9
        shuffle($numeros); // Mezcla los números aleatoriamente
        $semestres = implode(', ', array_slice($numeros, 0, $cantidadNumeros));
        $atributos = [
            'Paciencia' => $this->faker->numberBetween(0, 100),
            'Inteligencia' => $this->faker->numberBetween(0, 100),
            'Carisma' => $this->faker->numberBetween(0, 100),
            'tolerancia' => $this->faker->numberBetween(0, 100),
        ];


        $standUser = [
            '/profesores/jotaro.jpg',
            '/profesores/jolyne.jpg',
            '/profesores/dio.png',
        ];

        $imagen1 = $this->faker->randomElement($standUser);

        $stand = [
            '/stands/star_platinum.jpg',
            '/stands/stone_free.png',
            '/stands/the_world.png',
        ];

        $imagen2 = $this->faker->randomElement($stand);
        return [
            'nivel_edu' => $this->faker->word,
            'nombre' => $this->faker->name,
            'descripcion' => $this->faker->paragraph,
            'kills' => $this->faker->numberBetween(1, 100),
            'xp' => $this->faker->numberBetween(1, 100),
            'dificultad' => $this->faker->randomElement(['facil', 'intermedio', 'dificil']),
            'like' => $this->faker->numberBetween(10, 400),
            'peligro' => $this->faker->randomElement(['alto', 'medio', 'bajo', 'extremo']),
            'atributos' => $atributos,
            'curiosidades' => $this->faker->sentence,
            'horario' => $this->faker->randomElement(['matutino', 'vespertino']),
            'categoria' => $this->faker->word,
            'habilidades' => $habilidades,
            'semestres' => $semestres,
            'clases' => json_encode([
                'clases_frecuentes' => $this->faker->words(3),
                'clases_ocasionales' => $this->faker->words(2)
            ]),            
            'imagen' => json_encode([$imagen1, $imagen2]),
            'tema' => "/temas/stand_proud.mp3",
            'tipo' => implode(', ', $this->faker->words(4)),
            'correo' => $this->faker->unique()->safeEmail,
        ];
    }
}
