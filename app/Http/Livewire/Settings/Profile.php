<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class Profile extends Component
{
    protected $listeners = ['updateAvatar' => 'refreshAvatar'];

    public $username;

    public $photo;
    public $photo_src = 'https://vignette.wikia.nocookie.net/spiceandwolf/images/4/43/Horo.jpg/revision/latest?cb=20100410062559';

    public function render()
    {
        return view('livewire.settings.profile');
    }

    public function refreshAvatar($url, $photo)
    {
        $this->photo_src = $photo;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'username' => 'required|min:4'
        ]);
    }

    public function validateIfUsernameAlreadyExists($field)
    {
        dd(session()->all());
        session()->flash('username', 'Task was successful!');
    }
}
