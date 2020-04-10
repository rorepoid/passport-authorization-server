<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class Profile extends Component
{
    public $user;
    public $username;
    public $avatar = 'https://vignette.wikia.nocookie.net/spiceandwolf/images/4/43/Horo.jpg/revision/latest?cb=20100410062559';

    protected $listeners = [
        'updateAvatar'      => 'refreshAvatar',
    ];

    public function render()
    {
        return view('livewire.settings.profile');
    }

    public function refreshAvatar($url, $avatar)
    {
        $this->avatar = $avatar;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'username' => 'required|unique:users'
        ]);
    }
}
