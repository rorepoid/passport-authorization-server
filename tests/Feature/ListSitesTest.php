<?php

namespace Tests\Feature;

use \App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
}
