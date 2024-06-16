<?php

namespace App\Livewire;

use App\Models\Profesor;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class GestionAvatars extends Component
{
    use WithFileUploads;

    // Propiedades públicas para almacenar datos de la vista
    public $avatars, $nombre, $imagen, $prefijo;
    public $imagenPath;

    // Propiedades para controlar la visibilidad de los modales
    public $isOpen = false;
    public $imageToDelete;
    public $isOpenConfirmationModal = false;
    public $profesores;

    // Método para inicializar la creación de un nuevo avatar
    public function create()
    {
        $this->resetInputFields(); // Resetea los campos de entrada
        $this->openModal(); // Abre el modal
    }

    // Método para abrir el modal
    public function openModal()
    {
        $this->isOpen = true;
    }

    // Método para cerrar el modal
    public function closeModal()
    {
        $this->isOpen = false;
    }

    // Método privado para resetear los campos de entrada
    private function resetInputFields()
    {
        $this->nombre = '';
        $this->imagen = '';
        $this->prefijo = '';
        $this->imagenPath = '';
        $this->imageToDelete = '';
    }

    // Método para almacenar un nuevo avatar o actualizar uno existente
    public function store()
    {
        $rules = [
            'nombre' => 'required',
            'prefijo' => 'required',
        ];

        // Validar si se requiere una imagen
        if (!$this->imagenPath || $this->imagen) {
            $rules['imagen'] = 'required';
        }

        $this->validate($rules); // Valida los datos según las reglas definidas

        // Procesar la imagen si es una instancia de archivo subido
        if ($this->imagen instanceof \Illuminate\Http\UploadedFile) {
            $extension = $this->imagen->extension();
            $nombreArchivo = $this->prefijo . '_' . $this->nombre . '.' . $extension;

            // Si ya existe una imagen, eliminar la antigua
            if ($this->imagenPath) {
                Storage::delete('avatares/' . basename($this->imagenPath));
            }

            // Almacenar la nueva imagen
            $imagen1Path = 'storage/' . $this->imagen->storeAs('avatares', $nombreArchivo);
        } else {
            // Procesar la imagen si no es una instancia de archivo subido
            if ($this->prefijo) {
                $nombreArchivo = $this->prefijo . '_' . $this->nombre;
            } else {
                $nombreArchivo = $this->imagenPath ? $this->prefijo . '_' . $this->nombre : $this->imagen;
            }

            // Mover la imagen existente al nuevo nombre
            if ($this->imagenPath) {
                Storage::move('avatares/' . basename($this->imagenPath), 'avatares/' . $nombreArchivo);
            }

            $imagen1Path = $nombreArchivo; 
        }

        $this->closeModal(); // Cierra el modal
        $this->resetInputFields(); // Resetea los campos de entrada
    }

    // Método para editar un avatar existente
    public function edit($imagenPath)
    {
        $this->imagenPath = $imagenPath; // Establece la ruta de la imagen a editar
        $nombreCompleto = basename($imagenPath); 
        $nombreSinExtension = pathinfo($nombreCompleto, PATHINFO_FILENAME); 
        $nombreParts = explode('_', $nombreSinExtension); 
        $this->prefijo = $nombreParts[0] ?? '';
        $this->nombre = $nombreParts[1] ?? '';

        $this->openModal(); // Abre el modal
    }

    // Método para confirmar la eliminación de un avatar
    public function confirmDelete($avatar)
    {
        $this->imageToDelete = $avatar;
        $this->isOpenConfirmationModal = true;
    }

    // Método para cerrar el modal de confirmación de eliminación
    public function closeModalConfirmation()
    {
        $this->imageToDelete = '';
        $this->isOpenConfirmationModal = false;
    }

    // Método para eliminar un avatar
    public function delete()
    {
        // Eliminar la imagen si se ha especificado
        if ($this->imageToDelete) {
            Storage::delete($this->imageToDelete);
        }

        $this->resetInputFields(); // Resetea los campos de entrada
        $this->isOpenConfirmationModal = false; // Cierra el modal de confirmación

        session()->flash('message', 'Imagen eliminada correctamente.'); // Muestra un mensaje de éxito
    }

    // Método para renderizar la vista del componente
    public function render()
    {
        $this->avatars = Storage::files('avatares'); // Obtiene todos los archivos de avatares
        $this->profesores = Profesor::all(); // Obtiene todos los profesores
        return view('livewire.gestion-avatars'); // Renderiza la vista 'gestion-avatars'
    }
}
