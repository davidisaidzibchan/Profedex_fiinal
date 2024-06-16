<?php

namespace App\Livewire;

use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $countNoti = 0;

    public function mount()
    {
        $userId = Auth::id();
        $notificaciones = Notificacion::where('id_usuario', $userId)->get();

        foreach ($notificaciones as $notificacion) {
            if ($notificacion->estado == 0) { 
                $this->countNoti += 1;
            }
        }
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
