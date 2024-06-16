<?php

namespace App\Livewire;

use App\Models\Profesor as ModelsProfesor;
use Livewire\Component;

class Profesor extends Component
{
    public $profesor;
    public $porcentajes;

    public function mount($id)
    {
        $this->profesor = ModelsProfesor::find($id);
        $this->porcentajes = explode(', ', $this->profesor->atributo);
        
    }
    public function render()
    {
        $totalProfesores = ModelsProfesor::count();

        
        $posicionProfesor = ModelsProfesor::where('id', '<=', $this->profesor->id)->count();
        $atributos = $this->profesor->getAtributosAsArray();
        return view('livewire.profesor', [
            'totalProfesores' => $totalProfesores,
            'posicionProfesor' => $posicionProfesor,
            'atributos' => $atributos,
        ]);
    }
}
