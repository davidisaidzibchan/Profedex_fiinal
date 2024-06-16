<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea roles para administrador, curador y usuario
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'curador']);
        Role::create(['name' => 'user']);

        // Crea un usuario administrador
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Se establece la contraseña utilizando el método Hash::make
            'avatar_path' => null,
        ])->assignRole('admin'); // Asigna el rol de administrador al usuario creado

        // Obtiene todos los usuarios excepto el administrador creado anteriormente
        $users = User::where('id', '!=', 1)->get();

        // Asigna roles a los usuarios restantes
        foreach ($users as $index => $user) {
            if ($index < 3) {
                // Los primeros tres usuarios son curadores
                $user->assignRole('curador');
            } else {
                // Todos los demás son usuarios comunes
                $user->assignRole('user');
            }
        }
    }
}
