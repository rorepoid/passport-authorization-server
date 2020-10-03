<?php

namespace Tests\Feature;

use App\Http\Livewire\Sites\ListSites;
use App\Models\User;
use App\Models\Site;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ListSitesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_302_status_when_unauthenticated_user_goes_to_site_list_route()
    {
        $response = $this->get('/sites');

        $response->assertStatus(302);
    }

    /** @test */
    public function it_returns_200_status_when_authenticated_user_goes_to_site_list_route()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->get('/sites');

        $response->assertStatus(200);
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
        Role::findOrCreate('Super Admin');
        auth()->user()->assignRole('Super Admin');

        $sites = factory(Site::class, 5)->create();

        foreach($sites as $site) {
            Livewire::test(ListSites::class)
            ->assertStatus(200)
            ->assertSee($site->name);
        }
    }

    public function testUserCanNotSeeExternalSitesIfIsNotAdmin()
    {
        $this->actingAs(factory(User::class)->create());

        $external_sites = factory(Site::class, 5)->create();
        $own_sites = factory(Site::class, 2)->create([
            'user_id' => auth()->user()->id,
        ]);

        foreach($own_sites as $site) {
            Livewire::test(ListSites::class)
            ->assertSee($site->name);
        }

        foreach($external_sites as $site) {
            Livewire::test(ListSites::class)
            ->assertDontSee($site->name);
        }
    }

    /** @test */
    public function site_owner_can_see_only_own_sites()
    {
        /** TODO */
    }
}
