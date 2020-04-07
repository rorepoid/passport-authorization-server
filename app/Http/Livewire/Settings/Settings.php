<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Settings extends Component
{
    public function render()
    {
        return view('livewire.settings.settings');
    }

    public function goToProfile()
    {
        return view('livewire.settings.profile');
    }
}
