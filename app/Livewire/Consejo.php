<?php

namespace App\Livewire;

use App\Models\Consejo as ModelsConsejo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Consejo extends Component
{
    public $consejoId;
    public $user;
    public $openModal = false;

    public $savedText = '';
    protected $listeners = ['clearSavedText' => 'clearSavedText'];

    public function clearSavedText()
    {
        $this->savedText = '';
    }
    public function toggleSaved()
    {
        $consejo = ModelsConsejo::find($this->consejoId->id);

        if ($consejo) {
            // Cambiar el estado guardado del consejo
            $consejo->guardado = !$consejo->guardado;
            $consejo->save();
        }
        $this->savedText = $consejo->guardado ? 'Guardaste tu consejo, Nadie más lo verá que tú.' : 'Publicaste tu consejo, Lo verán los demás una vez aceptado por un curador.';
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
        $consejo = ModelsConsejo::find($this->consejoId->id);

        if ($consejo) {
            // Verificar si el usuario autenticado es el propietario del consejo
            if ($consejo->id_usuario === auth()->id()) {
                // Eliminar el consejo de la base de datos
                $consejo->delete();
            }
        }
        $this->closeModal();
        return redirect()->to('/dashboard');
    }
    public function like($idConsejo)
    {
        $this->toggleReaction($idConsejo, true);
    }

    public function dislike($idConsejo)
    {
        $this->toggleReaction($idConsejo, false);
    }

    private function toggleReaction($idConsejo, $reaction)
    {
        $existingReaction = DB::table('reaccion_usuarios')
            ->where('id_consejo', $idConsejo)
            ->where('id_usuario', $this->user->id)
            ->first();

        if ($existingReaction) {
            $existingReactionValue = $existingReaction->reaccion == 1 ? true : false;
            if ($existingReactionValue === $reaction) {
                $this->updateCounters($idConsejo, $reaction, false);
                DB::table('reaccion_usuarios')->where('id', $existingReaction->id)->delete();
            } else {
                // Si la reacción existente es diferente, actualiza la reacción en la tabla reaccion_usuarios
                DB::table('reaccion_usuarios')
                    ->where('id', $existingReaction->id)
                    ->update(['reaccion' => $reaction]);
                // Disminuimos el contador de la reacción existente y aumentamos el contador de la nueva reacción
                $this->updateCounters($idConsejo, !$reaction, false);
                $this->updateCounters($idConsejo, $reaction, true);
            }
        } else {
            // Si no existe, crea una nueva reacción y aumenta solo el contador del que se hizo clic
            DB::table('reaccion_usuarios')->insert([
                'id_consejo' => $idConsejo,
                'id_usuario' => $this->user->id,
                'reaccion' => $reaction,
            ]);
            $this->updateCounters($idConsejo, $reaction, true);
        }
    }
    private function updateCounters($idConsejo, $reaction, $increment)
    {
        $consejo = ModelsConsejo::findOrFail($idConsejo);
        if ($reaction) {
            $consejo->like += $increment ? 1 : -1;
        } else {
            $consejo->dislike += $increment ? 1 : -1;
        }
        $consejo->save();
    }

    public function mount($id)
    {
        $this->user = Auth::user();
        $this->consejoId = ModelsConsejo::find($id);
    }
    public function render()
    {
        return view('livewire.consejo');
    }
}
