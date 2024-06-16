<?php

namespace App\Livewire;

use App\Models\Consejo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MisConsejos extends Component
{
    public $search = '';
    public $consejos;
    public $selectedOption = 'A-Z';
    public $showNoResults;
    public $user;
    public $selectedConsejo;
    public $openModal = false;
    public $savedText = '';
    protected $listeners = ['clearSavedText' => 'clearSavedText'];

    public function clearSavedText()
    {
        $this->savedText = '';
    }
    public function toggleSaved()
    {
        $consejo = Consejo::find($this->selectedConsejo->id);

        if ($consejo) {
            // Cambiar el estado guardado del consejo
            $consejo->guardado = !$consejo->guardado;
            $consejo->save();
        }
        $this->savedText = $consejo->guardado ? 'Guardaste tu consejo, Nadie más lo verá que tú.' : 'Publicaste tu consejo, Lo verán los demás una vez aceptado por un curador.';
        $this->closeModal();
    }
    public function confirmDelete()
    {
        $this->openModal = true;
    }
    public function closeModal()
    {
        $this->openModal = false;
    }
    public function deleteConsejo()
    {
        $consejo = Consejo::find($this->selectedConsejo->id);

        if ($consejo) {
            if ($consejo->id_usuario === auth()->id()) {
                $this->openModal = false;
                $this->selectedConsejo = NULL;
                $consejo->delete();
            }
        }
    }

    public function like($consejoId)
    {
        $this->toggleReaction($consejoId, true);
    }

    public function dislike($consejoId)
    {
        $this->toggleReaction($consejoId, false);
    }

    private function toggleReaction($consejoId, $reaction)
    {
        $existingReaction = DB::table('reaccion_usuarios')
            ->where('id_consejo', $consejoId)
            ->where('id_usuario', $this->user->id)
            ->first();

        if ($existingReaction) {
            $existingReactionValue = $existingReaction->reaccion == 1 ? true : false;
            if ($existingReactionValue === $reaction) {
                $this->updateCounters($consejoId, $reaction, false);
                DB::table('reaccion_usuarios')->where('id', $existingReaction->id)->delete();
            } else {

                DB::table('reaccion_usuarios')
                    ->where('id', $existingReaction->id)
                    ->update(['reaccion' => $reaction]);

                $this->updateCounters($consejoId, !$reaction, false);
                $this->updateCounters($consejoId, $reaction, true);
            }
        } else {

            DB::table('reaccion_usuarios')->insert([
                'id_consejo' => $consejoId,
                'id_usuario' => $this->user->id,
                'reaccion' => $reaction,
            ]);
            $this->updateCounters($consejoId, $reaction, true);
        }
    }
    private function updateCounters($consejoId, $reaction, $increment)
    {
        $consejo = Consejo::findOrFail($consejoId);
        if ($reaction) {
            $consejo->like += $increment ? 1 : -1;
        } else {
            $consejo->dislike += $increment ? 1 : -1;
        }
        $consejo->save();

        $this->applySorting();
    }
    public function refreshLikes()
    {
    }
    public function changeSelectedOption($option)
    {
        $this->selectedOption = $option;
        $this->applySorting();
    }

    public function updatedSearch($value)
    {
        $this->search = $value;
        $this->applySorting();
    }

    public function toggleFavorite($consejoId)
    {
        $userId = Auth::id();

        $favoriteExists = DB::table('favoritos')
            ->where('id_usuario', $userId)
            ->where('id_consejo', $consejoId)
            ->exists();

        if ($favoriteExists) {
            DB::table('favoritos')
                ->where('id_usuario', $userId)
                ->where('id_consejo', $consejoId)
                ->delete();
        } else {
            DB::table('favoritos')->insert([
                'id_usuario' => $userId,
                'id_consejo' => $consejoId,
            ]);
        }
        $this->applySorting();
    }
    protected function applySorting()
    {
        $userId = auth()->id();

        $query = Consejo::query()
            ->where('id_usuario', $userId)
            ->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('consejo', 'like', '%' . $this->search . '%');
            });

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

        $this->consejos = $query->get();
        $this->showNoResults = $this->consejos->isEmpty();
    }

    public function verConsejo($id)
    {
        $consejo = Consejo::find($id);

        $this->selectedConsejo = $consejo;
    }
    public function cerrarConsejo()
    {
        $this->selectedConsejo = NULL;
    }
    public function redirectToMyRoute($consejoId)
    {
        return redirect()->to('consejos/' . $consejoId);
    }
    public function render()
    {
        $this->user = Auth::user();
        $this->applySorting();
        return view('livewire.mis-consejos');
    }
}
