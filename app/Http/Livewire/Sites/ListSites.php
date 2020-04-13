<?php

namespace App\Http\Livewire\Sites;

use App\Site;
use Livewire\Component;

class ListSites extends Component
{
    public function render()
    {
        return view('livewire.sites.list-sites', ['sites' => Site::all()]);
    }
}
