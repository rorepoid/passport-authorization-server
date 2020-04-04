<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class Profile extends Component
{
    public $name = '';

    public function render()
    {
        return view('livewire.profile.profile');
    }
}
