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
    public $profesores; // Lista de profesores
    public $materias; // Lista de materias

    public $titulo; // Título del consejo
    public $consejo; // Contenido del consejo
    public $semestre; // Semestre del consejo
    public $idMateria; // ID de la materia seleccionada
    public $idProfesor; // ID del profesor seleccionado
    public $etiquetas = []; // Etiquetas del consejo
    public $otraEtiqueta; // Nueva etiqueta personalizada
    public $etiquetasPersonalizadas = []; // Lista de etiquetas personalizadas
    public $esAnonimo = false; // Indica si el consejo es anónimo

    public $malaPalabra = ''; // Mensaje de advertencia para palabras altisonantes

    // Método para actualizar el contenido del consejo
    public function actualizarConsejo()
    {
        $this->updatedConsejo();
    }

    // Método que se llama cada vez que se actualiza el contenido del consejo
    public function updatedConsejo()
    {
        $this->malaPalabra = ''; // Resetea el mensaje de advertencia
        $palabrasAltisonantes = MalaPalabra::pluck('palabra')->toArray(); // Obtiene todas las palabras altisonantes

        // Verifica si el consejo contiene palabras altisonantes
        foreach ($palabrasAltisonantes as $palabra) {
            if (stripos($this->consejo, $palabra) !== false) {
                $this->malaPalabra = 'El consejo contiene palabras altisonantes. Por favor, sé respetuoso.';
                break;
            }
        }
    }

    // Método para agregar una nueva etiqueta personalizada
    public function agregarNuevaEtiqueta()
    {
        if (!empty($this->otraEtiqueta)) { // Verifica que la nueva etiqueta no esté vacía
            $nuevaEtiqueta = '#' . $this->otraEtiqueta;
            if (!in_array($nuevaEtiqueta, $this->etiquetasPersonalizadas)) { // Verifica que la etiqueta no exista ya
                $this->etiquetasPersonalizadas[] = $nuevaEtiqueta;
                $this->etiquetas[] = $nuevaEtiqueta;
            }
            $this->otraEtiqueta = ''; // Resetea el campo de nueva etiqueta
        }
    }

    // Método que se llama cuando se actualizan las etiquetas
    public function updatedEtiquetas($value)
    {
        // Filtra las etiquetas personalizadas para mantener solo las seleccionadas
        $this->etiquetasPersonalizadas = array_filter($this->etiquetasPersonalizadas, function ($tag) {
            return in_array($tag, $this->etiquetas);
        });
    }

    // Método que se ejecuta al montar el componente
    public function mount()
    {
        $this->profesores = Profesor::all(); // Obtiene todos los profesores
        $this->materias = Materia::all(); // Obtiene todas las materias
    }

    // Método para crear un nuevo consejo
    public function crearConsejo($publicar = false)
    {
        // Valida los campos requeridos
        $this->validate([
            'titulo' => 'required',
            'consejo' => 'required',
            'semestre' => 'required',
        ]);

        // Verifica si hay una advertencia de mala palabra
        if (!empty($this->malaPalabra)) {
            $this->addError('consejo', $this->malaPalabra);
            return; 
        }

        // Determina si el consejo es anónimo
        $anonimo = $this->esAnonimo ? true : false;

        // Convierte las etiquetas a formato JSON si no están vacías
        $etiquetas = empty($this->etiquetas) ? null : json_encode($this->etiquetas);

        // Determina si el consejo está guardado o publicado
        $guardado = $publicar ? false : true;

        // Crea el consejo en la base de datos
        Consejo::create([
            'titulo' => $this->titulo,
            'consejo' => $this->consejo,
            'semestre' => $this->semestre,
            'id_materia' => $this->idMateria,
            'id_profesor' => $this->idProfesor,
            'id_usuario' => auth()->id(), // ID del usuario autenticado
            'anonimo' => $anonimo,
            'etiquetas' => $etiquetas, 
            'estado' => false, // Estado inicial del consejo
            'like' => 0, // Inicializa el conteo de likes
            'dislike' => 0, // Inicializa el conteo de dislikes
            'guardado' => $guardado,
        ]);

        // Resetea los campos del formulario
        $this->reset(['titulo', 'consejo', 'semestre', 'idMateria', 'idProfesor', 'etiquetas', 'esAnonimo']);
        $this->dispatch('show-notification'); // Muestra una notificación
    }

    // Método para renderizar el componente
    public function render()
    {
        return view('livewire.consejo-post');
    }
}
