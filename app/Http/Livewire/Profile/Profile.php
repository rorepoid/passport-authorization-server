<?php

namespace App\Http\Livewire\Profile;

use App\User;
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
        $this->user = User::find($id);

        if ($this->user === null) {
            abort(404);
        }
    }
}
