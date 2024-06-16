<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class ProductoList extends Component
{
    public $productos;
    public function mount()
    {
        $this->productos = Producto::all();
    }
    public function render()
    {
        return view('livewire.producto-list');
    }
}
