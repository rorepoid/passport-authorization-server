<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUserAccountTest extends TestCase
{
    /** @test */
    public function it_returns_redirect_to_login_instead_of_account_view_if_user_is_not_authenticated()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
}
