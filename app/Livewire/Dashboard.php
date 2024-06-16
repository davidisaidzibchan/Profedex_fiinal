<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $activeTab; // Pestaña activa actualmente en el dashboard

    // Método que se ejecuta al montar el componente
    public function mount()
    {
        // Obtiene la pestaña activa desde la sesión o establece 'profex' como valor por defecto
        $this->activeTab = session()->get('active_tab', 'profex');
    }

    // Método para cambiar la pestaña activa
    public function switchTab($tab)
    {
        // Actualiza la pestaña activa con el valor proporcionado
        $this->activeTab = $tab;
        
        // Almacena la pestaña activa en la sesión
        session()->put('active_tab', $tab);
    }

    // Método para renderizar el componente
    public function render()
    {
        // Devuelve la vista del dashboard de Livewire
        return view('livewire.dashboard');
    }
}
