<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserCard extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.user.user-card');
    }

    public function mount(User $user = null)
    {
        $this->user = $user;
    }
}
