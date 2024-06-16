<?php

namespace App\Livewire;

use App\Models\Profesor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Livewire;

class ProfesList extends Component
{
    public $search = '';
    public $profesores;
    public $selectedOption = 'A-Z';
    public $showNoResults;

    public $flippedCards = [];
    public $selectedProfe;
    public $cantidadProfes;
    public $posicionProfe;
    public $atributos;

    public function toggleFlip($index)
    {

        $isFlipped = $this->flippedCards[$index] ?? false;


        if ($isFlipped) {
            unset($this->flippedCards[$index]);
        } else {

            $this->flippedCards[$index] = true;
        }
    }
    public function toggleLike($profesorId)
    {
        $userId = Auth::id();


        $likeExists = DB::table('profesor_like')
            ->where('id_usuario', $userId)
            ->where('id_profesor', $profesorId)
            ->exists();

        if ($likeExists) {

            DB::table('profesor_like')
                ->where('id_usuario', $userId)
                ->where('id_profesor', $profesorId)
                ->delete();

            DB::table('profesores')
                ->where('id', $profesorId)
                ->decrement('like');
        } else {

            DB::table('profesor_like')->insert([
                'id_usuario' => $userId,
                'id_profesor' => $profesorId,
            ]);

            DB::table('profesores')
                ->where('id', $profesorId)
                ->increment('like');
        }


        $this->dispatch('refreshLikes');
        $this->applySorting();
    }

    public function refreshLikes()
    {
        $this->applySorting();
    }
    public function changeSelectedOption($option)
    {
        $this->selectedOption = $option;
        $this->applySorting();
    }

    public function mount()
    {
        $this->applySorting();
    }

    public function updatedSearch($value)
    {

        $this->search = $value;
        $this->applySorting();
    }

    protected function applySorting()
    {

        $query = Profesor::query()->where(function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%');
        });

        switch ($this->selectedOption) {
            case 'A-Z':
                $query->orderBy('nombre');
                break;
            case 'Z-A':
                $query->orderByDesc('nombre');
                break;
            case 'Más popular':
                $query->orderByDesc('like');
                break;
            case 'Menos popular':
                $query->orderBy('like');
                break;
            case 'Mis likes':
                $query->whereIn('id', auth()->user()->profesores->pluck('id'));
                break;
            default:

                $query->orderBy('nombre');
                break;
        }

        $this->profesores = $query->get();
        $this->showNoResults = $this->profesores->isEmpty();
    }

    public function mostrarProfe($id)
    {
        $profe = Profesor::find($id);
        $this->posicionProfe = Profesor::where('id', $id)->pluck('id')->search($id);
        $this->atributos = $profe->getAtributosAsArray();
        $this->selectedProfe = $profe;
    }

    public function cerrarprofe()
    {
        $this->atributos = '';
        $this->posicionProfe = '';
        $this->selectedProfe = NULL;
    }
    public function redirectToMyRoute($profesorId)
    {
        return redirect()->to('profesores/' . $profesorId);
    }
    public function render()
    {
        $this->cantidadProfes = Profesor::count();
        return view('livewire.profes-list');
    }
}
