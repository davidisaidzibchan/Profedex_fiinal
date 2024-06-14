<?php

namespace App\Livewire;

use App\Models\Consejo;
use App\Models\Notificacion;
use App\Models\User;
use Livewire\Component;

class GestionNotificaciones extends Component
{
    public $notificaciones, $id_consejo, $id_usuario, $mensaje, $tipo, $estado = false, $noti_id;
    public $isOpen = false;
    public $notiIdToDelete;
    public $isOpenConfirmationModal = false;

    public $consejos;
    public $usuarios;
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
        $this->id_consejo = '';
        $this->id_usuario = '';
        $this->mensaje = '';
        $this->tipo = 1;
        $this->estado = false;
        $this->noti_id = '';
    }

    public function store()
    {
        $this->validate([
            'id_consejo' => 'required',
            'id_usuario' => 'required',
            'tipo' => 'required',
            'mensaje' => 'required',
        ]);
        $notiData = [
            'id_consejo' => $this->id_consejo,
            'id_usuario' => $this->id_usuario,
            'mensaje' => $this->mensaje,
            'tipo' => $this->tipo,
            'estado' =>  $this->estado = false,
        ];

        $notification = Notificacion::updateOrCreate(['id' => $this->noti_id], $notiData);

        session()->flash('message', $this->noti_id ? 'Notificacion actualizada correctamente.' : 'Notificacion creada correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $notification = Notificacion::findOrFail($id);
        $this->noti_id = $id;
        $this->id_consejo = $notification->id_consejo;
        $this->id_usuario = $notification->id_usuario;
        $this->mensaje = $notification->mensaje;
        $this->tipo = $notification->tipo;
        $this->estado = false;
        $this->openModal();
    }

    public function confirmDelete($notiId)
    {
        $this->notiIdToDelete = $notiId;
        $this->isOpenConfirmationModal = true;
    }
    public function closeModalConfirmation()
    {
        $this->notiIdToDelete = '';
        $this->isOpenConfirmationModal = false;
    }
    public function delete()
    {
        Notificacion::find($this->notiIdToDelete)->delete();
        $this->isOpenConfirmationModal = false;
        session()->flash('message', 'Notificacion eliminada correctamente.');
    }
    public function render()
    {
        $this->notificaciones = Notificacion::with('consejo', 'usuario')->get();
        $this->consejos = Consejo::all();
        $this->usuarios = User::all();
        return view('livewire.gestion-notificaciones');
    }
}
