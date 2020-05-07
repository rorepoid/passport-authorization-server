<?php

namespace Tests\Feature;

use App\{Site, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SitePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_update_sites()
    {
        // Arrange
        $admin = $this->createAdmin();

        $this->be($admin);

        $site = factory(Site::class)->create();

        // Act
        $result = Gate::allows('update-site', $site);

        // Assert
        $this->assertTrue($result);
    }

    /** @test */
    public function guest_cannot_update_sites(Type $var = null)
    {
        // Arrange
        $site = factory(Site::class)->create();

        // Act
        $result = Gate::allows('update-site', $site);

        // Assert
        $this->assertFalse($result);
    }

    public function createAdmin()
    {
        $user = factory(User::class)->create();
        Role::findOrCreate('Super Admin');
        $user->assignRole('Super Admin');
        return $user;
    }
}
