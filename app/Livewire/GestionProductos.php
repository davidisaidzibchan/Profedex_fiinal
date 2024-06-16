<?php

namespace App\Livewire;

use App\Models\Notificacion;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithFileUploads;

class GestionProductos extends Component
{
    use WithFileUploads;

    public $productos, $nombre, $precio = 0.0, $descripcion, $imagen, $producto_id;
    public $isOpen = false;
    public $productoIdToDelete;
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
        $this->precio = 0.0;
        $this->descripcion = '';
        $this->imagen = '';
        $this->producto_id = '';
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
            'imagen' => empty($this->imagen) ? 'required|image' : '',
        ]);

        $imagen1Path = $this->imagen instanceof \Illuminate\Http\UploadedFile ? 'storage/' . $this->imagen->storeAs('productos', $this->imagen->getClientOriginalName()) : $this->imagen;
        $productoData = [
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'descripcion' => $this->descripcion,
            'imagen_path' => $imagen1Path,
        ];

        $producto = Producto::updateOrCreate(['id' => $this->producto_id], $productoData);

        session()->flash('message', $this->producto_id ? 'Producto actualizado correctamente.' : 'Producto creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $this->producto_id = $id;
        $this->nombre = $producto->nombre;
        $this->precio = $producto->precio;
        $this->descripcion = $producto->descripcion;
        $this->imagen = $producto->imagen_path;

        $this->openModal();
    }

    public function confirmDelete($notiId)
    {
        $this->productoIdToDelete = $notiId;
        $this->isOpenConfirmationModal = true;
    }
    public function closeModalConfirmation()
    {
        $this->productoIdToDelete = '';
        $this->isOpenConfirmationModal = false;
    }
    public function delete()
    {
        Producto::find($this->productoIdToDelete)->delete();
        $this->isOpenConfirmationModal = false;
        session()->flash('message', 'Producto eliminada correctamente.');
    }

    public function render()
    {
        $this->productos = Producto::all();
        return view('livewire.gestion-productos');
    }
}
