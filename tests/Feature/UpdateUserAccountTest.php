<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Styde\Enlighten\Tests\EnlightenSetup;

class UpdateUserAccountTest extends TestCase
{
    use RefreshDatabase, EnlightenSetup;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpEnlighten();
    }

    /** @test */
    public function it_returns_redirect_to_login_instead_of_account_view_if_user_is_not_authenticated()
    {
        $response = $this->get(route('settings.account'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function it_returns_to_account_view_if_user_is_authenticated()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('settings.account'));

        $response->assertOk();
    }
}
