<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Storage;

class Profile extends Component
{

    public $user;

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
        $this->user['avatar'] = $avatar;
    }
}
