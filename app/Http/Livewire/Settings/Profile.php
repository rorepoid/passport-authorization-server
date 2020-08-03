<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Storage;

class Profile extends Component
{

    public $user;
    public $name;
    public $email;
    public $avatar;
    public $username;

    protected $listeners = [
        'updateAvatar'      => 'refreshAvatar',
    ];

    public function render()
    {
        return view('livewire.settings.profile');
    }

    public function mount()
    {
        $this->user     = auth()->user();
        $this->name     = $this->user->name;
        $this->email    = $this->user->email;
        $this->avatar   = $this->user->avatar;
        $this->username = $this->user->username;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'username' => 'required|unique:users,username,'.$this->user->id,
            'email' => 'required|unique:users,email,'.$this->user->id,
        ]);
    }

    public function refreshAvatar($url)
    {
        $this->avatar = $url;
    }
}
