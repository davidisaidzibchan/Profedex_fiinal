<?php

namespace App\Livewire;

use App\Models\Consejo;
use App\Models\Materia;
use App\Models\Profesor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditPendientes extends Component
{
    public $user; // Usuario autenticado
    public $consejoId; // ID del consejo a editar
    public $titulo; // Título del consejo
    public $consejo; // Contenido del consejo
    public $semestre; // Semestre asociado al consejo
    public $id_materia; // ID de la materia asociada
    public $id_profesor; // ID del profesor asociado
    public $etiquetas = []; // Etiquetas del consejo
    public $otraEtiqueta; // Etiqueta personalizada nueva
    public $etiquetasPersonalizadas = []; // Etiquetas personalizadas
    public $materias; // Lista de todas las materias
    public $profesores; // Lista de todos los profesores

    // Método que se ejecuta al montar el componente
    public function mount($id)
    {
        $this->user = Auth::user(); // Obtiene el usuario autenticado
        $consejo = Consejo::find($id); // Encuentra el consejo por ID

        if ($consejo) {
            // Asigna los valores del consejo a las propiedades del componente
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

        // Carga todas las materias y profesores
        $this->materias = Materia::all();
        $this->profesores = Profesor::all();
    }

    // Método para agregar una nueva etiqueta personalizada
    public function agregarNuevaEtiqueta()
    {
        if (!empty($this->otraEtiqueta)) {
            $nuevaEtiqueta = '#' . $this->otraEtiqueta;
            if (!in_array($nuevaEtiqueta, $this->etiquetas)) {
                $this->etiquetasPersonalizadas[] = $nuevaEtiqueta;
                $this->etiquetas[] = $nuevaEtiqueta;
            }
            $this->otraEtiqueta = ''; // Limpia el campo de nueva etiqueta
        }
    }

    // Método que se ejecuta al actualizar las etiquetas
    public function updatedEtiquetas($value)
    {
        $this->etiquetasPersonalizadas = array_filter($this->etiquetasPersonalizadas, function ($tag) {
            return in_array($tag, $this->etiquetas);
        });
    }

    // Método para actualizar el consejo
    public function updateConsejo()
    {
        // Validación de los datos
        $this->validate([
            'titulo' => 'required|string|max:255',
            'consejo' => 'required|string',
            'etiquetas' => 'nullable|array'
        ]);

        $consejo = Consejo::find($this->consejoId); // Encuentra el consejo por ID

        if ($consejo) {
            // Actualiza los valores del consejo
            $consejo->titulo = $this->titulo;
            $consejo->consejo = $this->consejo;
            $consejo->semestre = $this->semestre;
            $consejo->id_materia = $this->id_materia;
            $consejo->id_profesor = $this->id_profesor;
            $consejo->etiquetas = json_encode($this->etiquetas);

            $consejo->save(); // Guarda los cambios

            session()->flash('message', 'Consejo actualizado correctamente.');
            return redirect()->route('pendientes'); // Redirige a la ruta 'pendientes'
        } else {
            session()->flash('error', 'Consejo no encontrado.');
        }
    }

    // Método para renderizar el componente
    public function render()
    {
        return view('livewire.edit-pendientes');
    }
}
