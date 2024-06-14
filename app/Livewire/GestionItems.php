<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Items;
use App\Models\Profesor;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class GestionItems extends Component
{
    use WithFileUploads;

    public $items, $profesores, $id_profesor, $ruta, $idItem;
    public $isOpen = false;
    public $rutaTemporal;
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
        $this->id_profesor = '';
        $this->ruta = '';
        $this->idItem = '';
    }
    public function store()
    {
        $validatedData = $this->validate([
            'id_profesor' => 'required',
            'ruta' => $this->idItem ? 'nullable' : 'required|image',
        ]);

        if ($this->idItem && $this->ruta instanceof \Illuminate\Http\UploadedFile) {
            $rutaImagen = $this->ruta->store('items');
        } elseif (!$this->idItem && $this->ruta instanceof \Illuminate\Http\UploadedFile) {
            $rutaImagen = $this->ruta->store('items');
        } else {
            $rutaImagen = $this->ruta;
        }
    
        Item::updateOrCreate(['id' => $this->idItem], [
            'id_profesor' => $this->id_profesor,
            'ruta' => $rutaImagen ?? null,
        ]);
        
        session()->flash('message', $this->idItem ?  'Imagen actualizada correctamente.' : 'Imagen creada correctamente.' );

        $this->resetInputFields();
        $this->closeModal();
    }
    
    public function edit($id)
    {
        $item = Item::find($id);
        $this->idItem = $item->id;
        $this->id_profesor = $item->id_profesor;
        $this->ruta = $item->ruta;

        $this->openModal();
    }
    public function confirmDelete($id)
    {
        $this->idItem=$id;
        $this->isOpenConfirmationModal = true;
    }
    public function closeConfirmDelete()
    {
        $this->isOpenConfirmationModal = false;
        $this->resetInputFields();
    }
    public function delete()
    {
        $item=Item::find($this->idItem);
        if ($item->ruta) {
            Storage::delete($item->ruta);
        }
        $item->delete();
        session()->flash('message', 'Item eliminado correctamente.');
        $this->closeConfirmDelete();
    }

    public function render()
    {
        $this->items = Item::all();
        $this->profesores = Profesor::all();
        return view('livewire.gestion-items');
    }
}
