<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavBar extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.nav-bar');
    }

    public function goToProfile()
    {
        return redirect()->route('profile');
    }
}
