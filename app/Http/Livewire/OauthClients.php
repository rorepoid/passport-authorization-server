<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class OauthClients extends Component
{
    public function render()
    {
        return view('livewire.oauth-clients', [
            'clients' => '$clients'
        ]);
    }
}
