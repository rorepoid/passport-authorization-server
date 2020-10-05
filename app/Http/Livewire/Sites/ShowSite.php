<?php

namespace App\Http\Livewire\Sites;

use App\Models\Site;
use Livewire\Component;

class ShowSite extends Component
{
    public $site;

    public function render()
    {
        return view('livewire.sites.show-site', [
            'site' => $this->site,
        ]);
    }

    public function mount(Site $site)
    {
        $this->site = $site;
    }
}
