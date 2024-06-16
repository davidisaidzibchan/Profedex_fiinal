<?php

namespace App\Livewire;

use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationList extends Component
{
  public $notificaciones;
  public $openOverlay;

  public function mostrarOverlay($id)
  {
    $this->openOverlay = Notificacion::findOrFail($id);

    if ($this->openOverlay->estado == 0) {
      $this->openOverlay->estado = 1;
      $this->openOverlay->save();
    }
  }
  public function ocultarOverlay()
  {
    
    $this->openOverlay = '';
  }
  public function render()
  {
    $user_id = Auth::id();
    $this->notificaciones = Notificacion::where('id_usuario', $user_id)->get();

    
    return view('livewire.notification-list');
  }
}
