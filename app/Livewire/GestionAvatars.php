<?php

namespace App\Livewire;

use App\Models\Profesor;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class GestionAvatars extends Component
{
    use WithFileUploads;

    public $avatars, $nombre, $imagen, $prefijo;
    public $imagenPath;

    public $isOpen = false;
    public $imageToDelete;
    public $isOpenConfirmationModal = false;
    public $profesores;
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
        $this->imagen = '';
        $this->prefijo = '';
        $this->imagenPath = '';
        $this->imageToDelete = '';
    }
    public function store()
    {
        $rules = [
            'nombre' => 'required',
            'prefijo' => 'required',
        ];

        
        if (!$this->imagenPath || $this->imagen) {
            $rules['imagen'] = 'required';
        }

        $this->validate($rules);

        if ($this->imagen instanceof \Illuminate\Http\UploadedFile) {
            $extension = $this->imagen->extension();
            $nombreArchivo = $this->prefijo . '_' . $this->nombre . '.' . $extension;

            
            if ($this->imagenPath) {
                Storage::delete('avatares/' . basename($this->imagenPath));
            }

            
            $imagen1Path = $this->imagen instanceof \Illuminate\Http\UploadedFile ? 'storage/' . $this->imagen->storeAs('avatares', $nombreArchivo) : $this->imagen;
        } else {
            
            if ($this->prefijo) {
                $nombreArchivo = $this->prefijo . '_' . $this->nombre;
            } else {
                
                $nombreArchivo = $this->imagenPath ? $this->prefijo . '_' . $this->nombre : $this->imagen;
            }

            
            if ($this->imagenPath) {
                Storage::move('avatares/' . basename($this->imagenPath), 'avatares/' . $nombreArchivo);
            }

            $imagen1Path = $nombreArchivo; 
        }

        
        $this->closeModal();
        $this->resetInputFields();
    }
    public function edit($imagenPath)
    {
        $this->imagenPath = $imagenPath;
        $nombreCompleto = basename($imagenPath); 
        $nombreSinExtension = pathinfo($nombreCompleto, PATHINFO_FILENAME); 
        $nombreParts = explode('_', $nombreSinExtension); 
        $this->prefijo = $nombreParts[0] ?? '';
        $this->nombre = $nombreParts[1] ?? '';

        $this->openModal();
    }

    public function confirmDelete($avatar)
    {
        $this->imageToDelete = $avatar;
        $this->isOpenConfirmationModal = true;
    }

    public function closeModalConfirmation()
    {
        $this->imageToDelete = '';
        $this->isOpenConfirmationModal = false;
    }

    public function delete()
    {
        
        if ($this->imageToDelete) {
            Storage::delete($this->imageToDelete);
        }

        
        $this->resetInputFields();
        $this->isOpenConfirmationModal = false;
 
        session()->flash('message', 'Imagen eliminada correctamente.');
    }


    public function render()
    {
        $this->avatars = Storage::files('avatares');
        $this->profesores = Profesor::all();
        return view('livewire.gestion-avatars');
    }
}
