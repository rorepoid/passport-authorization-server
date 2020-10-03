<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public function render()
    {
        return view('livewire.user.users', [
            'users' => User::simplePaginate(12)
        ]);
    }
}
