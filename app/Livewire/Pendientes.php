<?php

namespace App\Livewire;

use App\Models\Consejo;
use App\Models\Voto;
use Livewire\Component;

class Pendientes extends Component
{
    public $consejos;

    public function votarAprobar($consejoId)
    {
        $this->votar($consejoId, 'aceptar');
    }

    public function votarDeclinar($consejoId)
    {
        $this->votar($consejoId, 'declinar');
    }

    private function votar($consejoId, $decision)
    {
        $usuario = auth()->user();

        
        $voto = Voto::where('id_consejo', $consejoId)
            ->where('id_usuario', $usuario->id)
            ->first();

        
        if ($voto && $voto->decision === $decision) {
            $voto->delete();
            $this->actualizarConteoVotos($consejoId);
        } else {
            
            if ($voto) {
                $voto->update(['decision' => $decision]);
            } else {
                
                Voto::create([
                    'id_consejo' => $consejoId,
                    'id_usuario' => $usuario->id,
                    'decision' => $decision,
                ]);
            }
        }
 
        
        $this->actualizarConteoVotos($consejoId);
    }

    private function actualizarConteoVotos($consejoId)
    {
        $conteoAprobados = Voto::where('id_consejo', $consejoId)->where('decision', 'aceptar')->count();
        $conteoDeclinados = Voto::where('id_consejo', $consejoId)->where('decision', 'declinar')->count();

        
        if ($conteoAprobados >= 3) {
            $consejo = Consejo::find($consejoId);
            $consejo->estado = true;
            $consejo->save();
            Voto::where('id_consejo', $consejoId)->delete();
            $this->mount();
        } elseif ($conteoDeclinados >= 3) {
            
            Voto::where('id_consejo', $consejoId)->delete();

            
            Consejo::find($consejoId)->delete();

            
            $this->mount();
        }
    }

    public function mount()
    {
        $this->consejos = Consejo::where('estado', false)
                            ->where('guardado', false)
                            ->get();

    }
    public function render()
    {
        return view('livewire.pendientes');
    }
}
