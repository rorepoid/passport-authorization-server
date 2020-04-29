<?php

namespace Tests\Feature;

use \App\User;
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
}
