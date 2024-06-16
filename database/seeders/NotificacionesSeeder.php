<?php

namespace Database\Seeders;

use App\Models\Consejo;
use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea 10 notificaciones utilizando el factory de la clase Notificacion
        Notificacion::factory()->count(10)->create();

        // Obtiene todos los usuarios y consejos disponibles
        $usuarios = User::all();
        $consejos = Consejo::all();

        // Recorre los usuarios y los asocia con algunos consejos y registra sus reacciones
        $usuarios->each(function ($usuario) use ($consejos) {
            // Selecciona al azar entre 1 y 5 consejos para asociarlos al usuario
            $consejosAsociados = $consejos->random(rand(1, 5));
            foreach ($consejosAsociados as $consejo) {
                // Asocia al usuario con el consejo actual y registra una reacción positiva
                $usuario->consejosReaccionados()->attach($consejo->id, ['reaccion' => true]);
            }
        });
    }
}
