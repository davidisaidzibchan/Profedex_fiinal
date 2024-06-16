<?php

namespace App\Livewire;

use App\Models\Consejo;
use App\Models\Materia;
use App\Models\Profesor;
use App\Models\User;
use Livewire\Component;

class GestionConsejos extends Component
{
    public $consejos, $titulo, $consejo, $semestre, $id_materia, $id_profesor, $id_usuario, $anonimo = false, $estado = false, $like, $dislike, $consejo_id;
    public $isOpen = false;
    public $consejoIdToDelete;
    public $isOpenConfirmationModal = false;
    public $materias, $profesores, $usuarios;
    public $etiquetas = [];
    public $otraEtiqueta;
    public $etiquetasPersonalizadas = [];

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

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->titulo = '';
        $this->consejo = '';
        $this->semestre = '';
        $this->id_materia = '';
        $this->id_profesor = '';
        $this->id_usuario = '';
        $this->anonimo = false;
        $this->etiquetas = [];
        $this->estado = false;
        $this->like = 0;
        $this->dislike = 0;
        $this->consejo_id = '';
    }

    public function store()
    {
        $this->validate([
            'titulo' => 'required',
            'consejo' => 'required',
            'semestre' => 'required',
            'id_usuario' => 'required',
            'anonimo' => 'required|boolean',
            'etiquetas' => 'required',
            'estado' => 'required|boolean',
        ]);

        $anonimo = $this->anonimo ? true : false;
        $estado = $this->estado ? true : false;

        $etiquetas = empty($this->etiquetas) ? null : json_encode($this->etiquetas);

        $idMateria = $this->id_materia === '' ? null : $this->id_materia;
        $idProfesor = $this->id_profesor === '' ? null : $this->id_profesor;
        

        $consejoData = [
            'titulo' => $this->titulo,
            'consejo' => $this->consejo,
            'semestre' => $this->semestre,
            'id_materia' =>  $idMateria,
            'id_profesor' => $idProfesor,
            'id_usuario' => $this->id_usuario,
            'anonimo' => $anonimo,
            'etiquetas' => $etiquetas,
            'estado' => $estado,
            'like' => $this->like,
            'dislike' => $this->dislike,
        ];

        $consejo = Consejo::updateOrCreate(['id' => $this->consejo_id], $consejoData);

        session()->flash('message', $this->consejo_id ? 'Consejo actualizado correctamente.' : 'Consejo creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $consejo = Consejo::findOrFail($id);
        $this->consejo_id = $id;
        $this->titulo = $consejo->titulo;
        $this->consejo = $consejo->consejo;
        $this->semestre = $consejo->semestre;
        $this->id_materia = $consejo->id_materia;
        $this->id_profesor = $consejo->id_profesor;
        $this->id_usuario = $consejo->id_usuario;
        $this->anonimo = $consejo->anonimo ? true : false;
        $this->etiquetas = json_decode($consejo->etiquetas, true);
        $this->estado = $consejo->estado ? true : false;
        $this->like = $consejo->like;
        $this->dislike = $consejo->dislike;

        $this->openModal();
    }

    public function confirmDelete($consejoId)
    {
        $this->consejoIdToDelete = $consejoId;
        $this->isOpenConfirmationModal = true;
    }

    public function delete()
    {
        Consejo::find($this->consejoIdToDelete)->delete();
        $this->isOpenConfirmationModal = false;
        session()->flash('message', 'Consejo eliminado correctamente.');
    }


    public function render()
    {
        $this->consejos = Consejo::with('materia', 'profesor')->get();
        $this->materias = Materia::all();
        $this->profesores=Profesor::all();
        $this->usuarios=User::all();
        return view('livewire.gestion-consejos');
    }
}
