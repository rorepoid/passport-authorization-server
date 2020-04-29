<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListSitesTest extends TestCase
{
    public function testUnauthenticateUserCanNotEnterInSitesRouteAndIsRedirected()
    {
        $response = $this->get('/sites');

        $response->assertStatus(302);
    }
}
