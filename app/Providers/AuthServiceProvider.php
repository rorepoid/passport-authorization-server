<?php

namespace App\Providers;

use App\Models\{Site, User};
use App\Policies\SitePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Site::class => SitePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        Gate::define('update-site', function (User $user, Site $site) {
            return $user->id === $site->user_id;
        });

        Passport::routes();

        Passport::tokensExpireIn(now()->addSeconds(15));

        Passport::refreshTokensExpireIn(now()->addMinutes(10));

        Passport::personalAccessTokensExpireIn(now()->addMinutes(10));

    }
}
