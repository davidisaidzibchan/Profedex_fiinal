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
        Notificacion::factory()->count(10)->create();


        $usuarios = User::all();
        $consejos = Consejo::all();

        // Recorre los usuarios y asociarlos con algunos consejos y registrar sus reacciones
        $usuarios->each(function ($usuario) use ($consejos) {
            $consejosAsociados = $consejos->random(rand(1, 5));
            foreach ($consejosAsociados as $consejo) {
                $usuario->consejosReaccionados()->attach($consejo->id, ['reaccion' => true]);
            }
        });
    }
}
