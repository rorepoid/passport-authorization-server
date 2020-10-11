<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\Settings\Profile;
use Livewire\Livewire;
use App\Models\User;
use Tests\TestCase;
use Styde\Enlighten\Tests\EnlightenSetup;

class UpdateUserProfile extends TestCase
{
    use RefreshDatabase, EnlightenSetup;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpEnlighten();
    }

    /**
     * A test to validate user username when update profile
     *
     * @return void
     */
    public function test_username_must_be_required()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test('settings.profile')
            ->set(['username' => ''])
            ->assertHasErrors(['username']);
        $this->assertTrue(true);
    }

    public function test_username_must_be_unique()
    {
        User::factory()->create([
            'username' => 'test',
        ]);
        $this->actingAs(User::factory()->create());

        Livewire::test('settings.profile')
            ->set(['username' => 'test'])
            ->assertHasErrors(['username']);
        $this->assertTrue(true);
    }
}
