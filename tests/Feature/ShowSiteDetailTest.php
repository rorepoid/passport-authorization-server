<?php

namespace Tests\Feature;

use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowSiteDetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function all_sites_have_their_own_details_view_url()
    {
        // Arrange
        $user = User::factory()->create();
        $site = Site::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        // Act
        $route = route('sites.show', ['site' => $site->id]);
        $response = $this->get($route);

        // Assert
        $response->assertOk();
    }
}
