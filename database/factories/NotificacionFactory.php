<?php

namespace Database\Factories;

use App\Models\Notificacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notificacion>
 */
class NotificacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Notificacion::class;

    public function definition()
    {
        return [
            'id_consejo' => rand(1, 10),
            'id_usuario' => rand(1, 10),
            'mensaje' => $this->faker->sentence,
            'tipo' => $this->faker->numberBetween(1, 3), 
            'estado' => $this->faker->boolean,
        ];
    }
}
