<?php

namespace App\Livewire;

use App\Models\Consejo;
use App\Models\ReaccionUsuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConsejosList extends Component
{
    public $search = ''; // Término de búsqueda ingresado por el usuario
    public $consejos; // Lista de consejos filtrados
    public $selectedOption = 'A-Z'; // Opción seleccionada para ordenar los consejos
    public $showNoResults; // Indicador para mostrar si no hay resultados
    public $user; // Usuario autenticado
    public $selectedConsejo; // Consejo seleccionado

    // Método para dar "like" a un consejo
    public function like($consejoId)
    {
        $this->toggleReaction($consejoId, true);
    }

    // Método para dar "dislike" a un consejo
    public function dislike($consejoId)
    {
        $this->toggleReaction($consejoId, false);
    }

    // Método privado para manejar la reacción (like o dislike) de un usuario a un consejo
    private function toggleReaction($consejoId, $reaction)
    {
        // Verifica si el usuario ya reaccionó a este consejo
        $existingReaction = DB::table('reaccion_usuarios')
            ->where('id_consejo', $consejoId)
            ->where('id_usuario', $this->user->id)
            ->first();

        if ($existingReaction) {
            $existingReactionValue = $existingReaction->reaccion == 1 ? true : false;
            if ($existingReactionValue === $reaction) {
                // Si la reacción actual es la misma que la nueva, elimina la reacción
                $this->updateCounters($consejoId, $reaction, false);
                DB::table('reaccion_usuarios')->where('id', $existingReaction->id)->delete();
            } else {
                // Si la reacción es diferente, actualiza la reacción existente
                DB::table('reaccion_usuarios')
                    ->where('id', $existingReaction->id)
                    ->update(['reaccion' => $reaction]);

                // Actualiza los contadores de reacciones en el consejo
                $this->updateCounters($consejoId, !$reaction, false);
                $this->updateCounters($consejoId, $reaction, true);
            }
        } else {
            // Si no existe una reacción previa, crea una nueva
            DB::table('reaccion_usuarios')->insert([
                'id_consejo' => $consejoId,
                'id_usuario' => $this->user->id,
                'reaccion' => $reaction,
            ]);
            $this->updateCounters($consejoId, $reaction, true);
        }
    }

    // Método privado para actualizar los contadores de likes y dislikes en un consejo
    private function updateCounters($consejoId, $reaction, $increment)
    {
        $consejo = Consejo::findOrFail($consejoId);
        if ($reaction) {
            $consejo->like += $increment ? 1 : -1;
        } else {
            $consejo->dislike += $increment ? 1 : -1;
        }
        $consejo->save();

        // Aplica la ordenación después de actualizar los contadores
        $this->applySorting();
    }

    // Método para refrescar los likes (actualmente vacío, puede ser implementado en el futuro)
    public function refreshLikes()
    {
    }

    // Método para cambiar la opción seleccionada y aplicar la ordenación correspondiente
    public function changeSelectedOption($option)
    {
        $this->selectedOption = $option;
        $this->applySorting();
    }

    // Método que se ejecuta al montar el componente
    public function mount()
    {
        $this->user = Auth::user(); // Obtiene el usuario autenticado
        $this->applySorting(); // Aplica la ordenación inicial
    }

    // Método que se ejecuta cuando se actualiza el término de búsqueda
    public function updatedSearch($value)
    {
        $this->search = $value;
        $this->applySorting();
    }

    // Método para agregar o quitar un consejo de los favoritos
    public function toggleFavorite($consejoId)
    {
        $userId = Auth::id(); // Obtiene el ID del usuario autenticado

        // Verifica si el consejo ya está en los favoritos del usuario
        $favoriteExists = DB::table('favoritos')
            ->where('id_usuario', $userId)
            ->where('id_consejo', $consejoId)
            ->exists();

        if ($favoriteExists) {
            // Si ya está en favoritos, lo elimina
            DB::table('favoritos')
                ->where('id_usuario', $userId)
                ->where('id_consejo', $consejoId)
                ->delete();
        } else {
            // Si no está en favoritos, lo agrega
            DB::table('favoritos')->insert([
                'id_usuario' => $userId,
                'id_consejo' => $consejoId,
            ]);
        }
        $this->applySorting(); // Aplica la ordenación después de modificar los favoritos
    }

    // Método protegido para aplicar la ordenación y filtrado a los consejos
    protected function applySorting()
    {
        $query = Consejo::query()->where(function ($query) {
            $query->where('titulo', 'like', '%' . $this->search . '%')
                ->orWhere('consejo', 'like', '%' . $this->search . '%');
        })->where('estado', true) // Solo incluye consejos con estado verdadero
            ->where('guardado', false); // Excluye consejos guardados

        // Aplica la ordenación según la opción seleccionada
        switch ($this->selectedOption) {
            case 'A-Z':
                $query->orderBy('titulo');
                break;
            case 'Z-A':
                $query->orderByDesc('titulo');
                break;
            case 'Más popular':
                $query->orderByDesc('like');
                break;
            case 'Menos popular':
                $query->orderByDesc('dislike');
                break;
            case 'Favoritos':
                $query->whereIn('id', auth()->user()->favoritos->pluck('id'));
                break;
            default:
                $query->orderBy('nombre');
                break;
        }

        $this->consejos = $query->get(); // Obtiene la lista de consejos filtrados y ordenados
        $this->showNoResults = $this->consejos->isEmpty(); // Indica si no hay resultados
    }

    // Método para ver el detalle de un consejo
    public function verConsejo($id)
    {
        $consejo = Consejo::find($id);
        $this->selectedConsejo = $consejo; // Establece el consejo seleccionado
    }

    // Método para cerrar el detalle del consejo
    public function cerrarConsejo()
    {
        $this->selectedConsejo = NULL; // Resetea el consejo seleccionado
    }

    // Método para redirigir a una ruta específica con el ID del consejo
    public function redirectToMyRoute($consejoId)
    {
        return redirect()->to('consejos/' . $consejoId);
    }

    // Método para renderizar el componente
    public function render()
    {
        return view('livewire.consejos-list');
    }
}
