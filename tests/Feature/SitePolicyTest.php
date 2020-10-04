<?php

namespace Tests\Feature;

use App\Models\{Site, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SitePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admins_can_update_sites()
    {
        // Arrange
        $admin = $this->createAdmin();

        $this->be($admin);

        $site = Site::factory()->create();

        // Act
        $result = Gate::allows('update-site', $site);

        // Assert
        $this->assertTrue($result);
    }

    /** @test */
    public function guest_cannot_update_sites()
    {
        // Arrange
        $site = Site::factory()->create();

        // Act
        $result = Gate::allows('update-site', $site);

        // Assert
        $this->assertFalse($result);
    }

    /** @test */
    public function site_owner_can_update_owned_sites()
    {
        // Arrange
        $this->be($this->createUser());

        $site = $this->createSite([
            'user_id' => auth()->user()->id,
        ]);

        // Act
        $result = Gate::allows('update-site', $site);

        // Assert
        $this->assertTrue($result);
    }

    /** @test */
    public function user_cannot_update_non_own_sites()
    {
        // Arrange
        $user = $this->createUser();

        $this->be($user);

        $site = $this->createSite([
            'user_id' => $user->id + 1,
        ]);

        // Act
        $result = Gate::allows('update-site', $site);

        // Assert
        $this->assertFalse($result);
    }

    public function createUser(array $columns = [])
    {
        return User::factory()->create($columns);
    }

    public function createSite(array $columns = [])
    {
        return Site::factory()->create($columns);
    }

    public function createAdmin()
    {
        $user = User::factory()->create();
        Role::findOrCreate('Super Admin');
        $user->assignRole('Super Admin');
        return $user;
    }
}
