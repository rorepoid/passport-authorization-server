<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\Settings\Profile;
use Livewire\Livewire;
use App\User;
use Tests\TestCase;

class UpdateUserProfile extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to validate user username when update profile
     *
     * @return void
     */
    public function test_username_must_be_required()
    {
        $this->actingAs(factory(User::class)->create());

        Livewire::test('settings.profile')
            ->set(['username' => ''])
            ->assertHasErrors(['username']);
        $this->assertTrue(true);
    }
}
