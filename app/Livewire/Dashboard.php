<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{ 
    public $activeTab;

    public function mount()
    {
        $this->activeTab = session()->get('active_tab', 'profex');
    }
    
    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        
        session()->put('active_tab', $tab);
    }

    public function render()
    {
        return view('livewire.dashboard');
    } 
}
