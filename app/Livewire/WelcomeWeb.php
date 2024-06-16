<?php

namespace App\Livewire;

use App\Models\Consejo;
use App\Models\Profesor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WelcomeWeb extends Component
{
    public $consejos;
    public $profes;
    public $email;
    public $password;
    
    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];
    
        if (Auth::attempt($credentials)) {
            auth()->login(Auth::user());
            return redirect()->intended('/dashboard'); 
        } else {
            session()->flash('error', 'Correo electrónico o contraseña incorrectos.');
        }
    }
    
    public function render()
    {
        $this->consejos = Consejo::where('estado', true)->take(4)->get();
        $this->profes = Profesor::all();
        return view('livewire.welcome-web');
    }
}
