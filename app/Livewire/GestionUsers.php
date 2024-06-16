<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class GestionUsers extends Component
{
    public $users, $name, $username, $email, $password, $avatar_path, $user_id;
    public $roles;
    public $rol;
    public $isOpen = false;
    public $userIdToDelete;
    public $isOpenConfirmationModal = false;
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
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->user_id = '';
        $this->avatar_path = '/avatar/mario_cow.png';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $this->user_id,
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'rol' => 'required', 
        ]);

        $userData = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'avatar_path' => $this->avatar_path,
        ];

        
        if (!$this->user_id) {
            $this->validate(['password' => 'required|min:6']);
            $userData['password'] = Hash::make($this->password);
        } elseif ($this->password) {
            
            $this->validate(['password' => 'nullable|min:6']);
            $userData['password'] = Hash::make($this->password);
        }

        $user = User::updateOrCreate(['id' => $this->user_id], $userData);

        
        $user->syncRoles([$this->rol]);

        session()->flash('message', $this->user_id ? 'Usuario actualizado correctamente.' : 'Usuario creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->password = ''; 
        $this->avatar_path = $user->avatar_path;
        $this->rol = $user->roles->first()->name; 

        $this->openModal();
    }

    public function confirmDelete($userId)
    {
        $this->userIdToDelete = $userId;
        $this->isOpenConfirmationModal = true;
    }
    public function closeModalConfirmation()
    {
        $this->userIdToDelete = '';
        $this->isOpenConfirmationModal = false;
    }
    public function delete()
    {
        User::find($this->userIdToDelete)->delete();
        $this->isOpenConfirmationModal = false;
        session()->flash('message', 'Usuario eliminado correctamente.');
    }
    public function render()
    {
        $this->users = User::where('id', '!=', 1)->get();
        $this->roles = Role::all();
        return view('livewire.gestion-users');
    }
}
