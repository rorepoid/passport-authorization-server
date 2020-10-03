<?php

namespace App\Http\Livewire\Sites;

use App\Models\Site;
use Livewire\Component;

class ListSites extends Component
{
    public function render()
    {
        return view('livewire.sites.list-sites', [
            'sites' => $this->getSites()
        ]);
    }

    public function getSites()
    {
        if (auth()->user()->hasRole('Super Admin') === true) {
            return Site::all();
        }

        return Site::whereUserId(auth()->user()->id)->get();
    }
}
