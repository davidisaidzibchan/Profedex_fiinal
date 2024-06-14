<?php

namespace App\Livewire;

use App\Models\Consejo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Perfil extends Component
{
    public $userAuth;
    public $numeroReacciones;
    public $numConsejos;
    public $openOverlay;
    public $avatars;

    public function mostrarOverlay()
    {
      $this->openOverlay = 'yes';
    }
    public function ocultarOverlay()
    {
      $this->openOverlay = '';
    }
    public function mount()
    {
        $this->userAuth = Auth::user();
        $this->numeroReacciones = number_format(DB::table('reaccion_usuarios')
            ->where('id_usuario', $this->userAuth->id)
            ->where('reaccion', true)
            ->count(), 0, '.', ',');
        $this->numConsejos = Consejo::where('id_usuario', $this->userAuth->id)->count();

   
        $this->avatars = Storage::files('avatares');
    }
    public function seleccionarImagen($imagen)
    {
        $userId = Auth::id();

        $usuario = User::find($userId);
        if ($usuario) {
            $usuario->avatar_path = $imagen;
            $usuario->save();

            $this->userAuth = $usuario;
        }
        $this->ocultarOverlay();
    }
    public function render()
    {
        return view('livewire.perfil');
    }
}
