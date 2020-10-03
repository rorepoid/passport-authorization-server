<?php

namespace App\Http\Livewire\Sites;

use App\Models\Site;
use Livewire\Component;

class SiteComponent extends Component
{
    public $site;

    public function render()
    {
        return view('livewire.sites.site-component');
    }

    public function mount(Site $site)
    {
        $this->site = $site;
    }
}
