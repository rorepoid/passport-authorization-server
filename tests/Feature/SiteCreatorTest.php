<?php

namespace Tests\Feature;

use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Styde\Enlighten\Tests\EnlightenSetup;

class SiteCreatorTest extends TestCase
{
    use RefreshDatabase, EnlightenSetup;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpEnlighten();
    }

    /** @test */
    public function site_creator_is_added_in_site_members()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $site = Site::factory()->create([
            'user_id' => $user->id,
        ]);

        $site = $site->refresh();

        // Assert
        $this->assertTrue($site->users->count() > 0);
    }
}
