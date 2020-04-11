<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class Profile extends Component
{

    public $user;
    public $avatar = 'https://vignette.wikia.nocookie.net/spiceandwolf/images/4/43/Horo.jpg/revision/latest?cb=20100410062559';

    protected $listeners = [
        'updateAvatar'      => 'refreshAvatar',
    ];

    public function render()
    {
        return view('livewire.settings.profile');
    }

    public function mount()
    {
        $this->user = auth()->user()->toArray();
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'user.username' => 'required|unique:users,username,'.$this->user['id'],
            'user.email' => 'required|unique:users,email,'.$this->user['id'],
        ]);
    }

    public function refreshAvatar($url, $avatar)
    {
        $this->avatar = $avatar;
    }
}
