<?php

namespace Tests\Feature;

use App\Http\Livewire\Sites\ListSites;
use \App\User;
use \App\Site;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ListSitesTest extends TestCase
{
    use RefreshDatabase;

    public function testUnauthenticateUserCanNotEnterInSitesRouteAndIsRedirected()
    {
        $response = $this->get('/sites');

        $response->assertStatus(302);
    }

    public function testReturn403ToAccessToSitesRouteIfUserDoNotHavePermission()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->get('/sites');

        $response->assertStatus(403);
    }

    public function testReturn200ToAccessToSitesRouteIfUserIsAdmin()
    {
        $this->actingAs(factory(User::class)->create());
        Role::findOrCreate('Super Admin');
        auth()->user()->assignRole('Super Admin');

        $response = $this->get('/sites');

        $response->assertStatus(200);
    }

    public function testUserCanSeeAllSitesInSitesRouteIfIsAdmin()
    {
        $this->actingAs(factory(User::class)->create());
        factory(Site::class, 5)->create();
        $sites =Site::all();
        Role::findOrCreate('Super Admin');
        auth()->user()->assignRole('Super Admin');
        foreach($sites as $site) {
            Livewire::test(ListSites::class)
            ->assertStatus(200)
            ->assertSee($site->name);
        }
    }
}
