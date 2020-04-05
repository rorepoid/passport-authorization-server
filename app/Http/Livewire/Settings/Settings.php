<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Settings extends Component
{
    protected $listeners = ['updatePhoto' => 'refreshPhoto'];
    public $photo;
    public $photo_src = 'https://vignette.wikia.nocookie.net/spiceandwolf/images/4/43/Horo.jpg/revision/latest?cb=20100410062559';

    public function render()
    {
        return view('livewire.settings.settings');
    }

    public function goToProfile()
    {
        return view('livewire.settings.profile');
    }

    public function refreshPhoto($url, $photo)
    {
        $this->photo_src = $photo;
    }
}
