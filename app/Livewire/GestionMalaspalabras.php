<?php

namespace App\Livewire;

use App\Models\MalaPalabra;
use Livewire\Component;

class GestionMalaspalabras extends Component
{
    public $malaspalabras;
    public $palabra;
    public $palabraId;

    public function mount()
    {
        $this->malaspalabras = Malapalabra::all();
    }

    public function store()
    {
        $this->validate([
            'palabra' => 'required|string|max:255|unique:malas_palabras,palabra',
        ]);

        Malapalabra::create(['palabra' => $this->palabra]);

        $this->resetInput();
        $this->malaspalabras = Malapalabra::all();
    }

    public function edit($id)
    {
        $palabra = Malapalabra::findOrFail($id);
        $this->palabraId = $id;
        $this->palabra = $palabra->palabra;
    }

    public function update()
    {
        $this->validate(['palabra' => 'required|string|max:255']);

        $palabra = Malapalabra::findOrFail($this->palabraId);
        $palabra->update(['palabra' => $this->palabra]);

        $this->resetInput();
        $this->malaspalabras = Malapalabra::all();
    }

    public function delete($id)
    {
        Malapalabra::findOrFail($id)->delete();
        $this->malaspalabras = Malapalabra::all();
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->palabra = '';
        $this->palabraId = null;
    }

    public function render()
    {
        return view('livewire.gestion-malaspalabras');
    }   
}
