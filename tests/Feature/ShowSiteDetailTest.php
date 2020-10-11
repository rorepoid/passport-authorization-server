<?php

namespace Tests\Feature;

use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Styde\Enlighten\Tests\EnlightenSetup;

class ShowSiteDetailTest extends TestCase
{
    use RefreshDatabase, EnlightenSetup;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpEnlighten();
    }

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
