<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserRectangleCard extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.user.user-rectangle-card');
    }

    public function mount(User $user)
    {
        $this->user = $user;
    }
}
