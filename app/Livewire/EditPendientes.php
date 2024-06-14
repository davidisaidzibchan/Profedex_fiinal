<?php

namespace App\Livewire;

use App\Models\Consejo;
use App\Models\Materia;
use App\Models\Profesor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditPendientes extends Component
{
    public $user;
    public $consejoId;
    public $titulo;
    public $consejo;
    public $semestre;
    public $id_materia;
    public $id_profesor;
    public $etiquetas = [];
    public $otraEtiqueta;
    public $etiquetasPersonalizadas = [];
    public $materias;
    public $profesores;

    public function mount($id)
    {
        $this->user = Auth::user();
        $consejo = Consejo::find($id);

        if ($consejo) {
            $this->consejoId = $consejo->id;
            $this->titulo = $consejo->titulo;
            $this->consejo = $consejo->consejo;
            $this->semestre = $consejo->semestre;
            $this->id_materia = $consejo->id_materia;
            $this->id_profesor = $consejo->id_profesor;
            $this->etiquetas = json_decode($consejo->etiquetas, true) ?? []; 
            $this->etiquetasPersonalizadas = array_filter($this->etiquetas, function ($tag) {
                return !in_array($tag, ['#salvasemestres', '#hack', '#chismesito', '#útil', '#hate', '#microconsejo']);
            });
        }

        $this->materias = Materia::all();
        $this->profesores = Profesor::all();
    }

    public function agregarNuevaEtiqueta()
    {
        if (!empty($this->otraEtiqueta)) {
            $nuevaEtiqueta = '#' . $this->otraEtiqueta;
            if (!in_array($nuevaEtiqueta, $this->etiquetas)) {
                $this->etiquetasPersonalizadas[] = $nuevaEtiqueta;
                $this->etiquetas[] = $nuevaEtiqueta;
            }
            $this->otraEtiqueta = '';
        }

    }

    public function updatedEtiquetas($value)
    {
        $this->etiquetasPersonalizadas = array_filter($this->etiquetasPersonalizadas, function ($tag) {
            return in_array($tag, $this->etiquetas);
        });
    }

    public function updateConsejo()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'consejo' => 'required|string',
            'etiquetas' => 'nullable|array'
        ]);

        $consejo = Consejo::find($this->consejoId);

        if ($consejo) {
            $consejo->titulo = $this->titulo;
            $consejo->consejo = $this->consejo;
            $consejo->semestre = $this->semestre;
            $consejo->id_materia = $this->id_materia;
            $consejo->id_profesor = $this->id_profesor;
            $consejo->etiquetas = json_encode($this->etiquetas);

            $consejo->save();

            session()->flash('message', 'Consejo actualizado correctamente.');
            return redirect()->route('pendientes');
        } else {
            session()->flash('error', 'Consejo no encontrado.');
        }
    }

    public function render()
    {
        return view('livewire.edit-pendientes');
    }
}
