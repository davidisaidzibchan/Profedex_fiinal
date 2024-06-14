<?php

namespace App\Livewire;

use App\Models\Consejo;
use App\Models\MalaPalabra;
use App\Models\Materia;
use App\Models\Profesor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConsejoPost extends Component
{
    public $profesores;
    public $materias;

    public $titulo;
    public $consejo;
    public $semestre;
    public $idMateria;
    public $idProfesor;
    public $etiquetas = [];
    public $otraEtiqueta;
    public $etiquetasPersonalizadas = [];
    public $esAnonimo = false;

    public $malaPalabra = '';

    public function actualizarConsejo()
    {
        $this->updatedConsejo();
    }
    public function updatedConsejo()
    {
        $this->malaPalabra = '';
        $palabrasAltisonantes = MalaPalabra::pluck('palabra')->toArray();

        foreach ($palabrasAltisonantes as $palabra) {
            if (stripos($this->consejo, $palabra) !== false) {
                $this->malaPalabra = 'El consejo contiene palabras altisonantes. Por favor, sé respetuoso.';
                break;
            }
        }
    }

    public function agregarNuevaEtiqueta()
    {
        if (!empty($this->otraEtiqueta)) {
            $nuevaEtiqueta = '#' . $this->otraEtiqueta;
            if (!in_array($nuevaEtiqueta, $this->etiquetasPersonalizadas)) {
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
    public function mount()
    {
        $this->profesores = Profesor::all();
        $this->materias = Materia::all();
    }

    public function crearConsejo($publicar = false)
    {
        
        $this->validate([
            'titulo' => 'required',
            'consejo' => 'required',
            'semestre' => 'required',
        ]);
        if (!empty($this->malaPalabra)) {
            $this->addError('consejo', $this->malaPalabra);
            return; 
        }

        
        $anonimo = $this->esAnonimo ? true : false;

        $etiquetas = empty($this->etiquetas) ? null : json_encode($this->etiquetas);

        $guardado = $publicar ? false : true;
        
        Consejo::create([
            'titulo' => $this->titulo,
            'consejo' => $this->consejo,
            'semestre' => $this->semestre,
            'id_materia' => $this->idMateria,
            'id_profesor' => $this->idProfesor,
            'id_usuario' => auth()->id(), 
            'anonimo' => $anonimo,
            'etiquetas' => $etiquetas, 
            'estado' => false, 
            'like' => 0,
            'dislike' => 0,
            'guardado' => $guardado,
        ]);

        
        $this->reset(['titulo', 'consejo', 'semestre', 'idMateria', 'idProfesor', 'etiquetas', 'esAnonimo']);
        $this->dispatch('show-notification');
    }
    public function render()
    {
        return view('livewire.consejo-post');
    }
}
