<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class OauthClients extends Component
{
    public function render()
    {
        $clients = Http::get(url('/oauth/clients'));
// dd($clients->body());
        return view('livewire.oauth-clients', [
            'clients' => $clients
            ]);
    }
}
