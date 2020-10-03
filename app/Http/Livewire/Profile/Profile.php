<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.profile.profile', ['user' => $this->user]);
    }

    public function mount(int $id = null)
    {
        $this->user = $this->getUser($id);

        if ($this->user === null) {
            abort(404);
        }
    }

    public function getUser(int $id = null)
    {
        if ($id === null) {
            return auth()->user();
        }

        return User::find($id);
    }
}
