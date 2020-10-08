<?php

namespace App\Http\Livewire\Sites;

use App\Models\Site;
use App\Models\User;
use Livewire\Component;

class ShowSite extends Component
{
    public $site;
    public $user;
    public $users;

    public function render()
    {
        return view('livewire.sites.show-site', [
            'site' => $this->site,
        ]);
    }

    public function mount(Site $site)
    {
        $this->site = $site;
        $this->user = User::find($site->user_id);
    }

    public function loadUsers()
    {
        $this->users = $this->site->users;
    }
}
