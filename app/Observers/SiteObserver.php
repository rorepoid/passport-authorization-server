<?php

namespace App\Observers;

use App\Models\Site;
use App\Models\User;

class SiteObserver
{
    public function created(Site $site)
    {
        $site->users()->attach(User::find($site->user_id));
    }
}
