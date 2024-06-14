<?php

namespace App\Livewire;

use App\Models\Materia;
use Livewire\Component;

class GestionMaterias extends Component
{
    public $materias, $nombre, $materia_id;
    public $isOpen = false;
    public $materiaIdToDelete;
    public $isOpenConfirmationModal = false;

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
        $this->nombre = '';
        $this->materia_id = '';
    }

    public function store() 
    {
        $this->validate([
            'nombre' => 'required|unique:materias,nombre,' . $this->materia_id . ',id',
        ]);
        
        $materiaData = [
            'nombre' => $this->nombre,
        ];

        $materia = Materia::updateOrCreate(['id' => $this->materia_id], $materiaData);

        session()->flash('message', $this->materia_id ? 'Materia actualizada correctamente.' : 'Materia creada correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $materia = Materia::findOrFail($id);
        $this->materia_id = $id;
        $this->nombre = $materia->nombre;

        $this->openModal();
    }

    public function confirmDelete($materiaId)
    {
        $this->materiaIdToDelete = $materiaId;
        $this->isOpenConfirmationModal = true;
    }

    public function delete()
    {
        Materia::find($this->materiaIdToDelete)->delete();
        $this->isOpenConfirmationModal = false;
        session()->flash('message', 'Materia eliminada correctamente.');
    }

    public function render()
    {
        $this->materias = Materia::all();
        return view('livewire.gestion-materias');
    }
}
