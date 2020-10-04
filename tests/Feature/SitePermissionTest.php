<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SitePermissionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * User has resource permissions of any site.
     *
     * @return void
     */
    public function testUserPermissionToViewCreateEditAndDeleteAnySites()
    {
        $john = User::factory()->create();

        Permission::findOrCreate('sites.view,create,edit,delete.*');
        $john->givePermissionTo('sites.view,create,edit,delete.*');
        $this->assertTrue($john->can('sites.view'));
        $this->assertTrue($john->can('sites.create.1'));
        $this->assertTrue($john->can('sites.edit.8'));
        $this->assertTrue($john->can('sites.delete.10'));
        $this->assertTrue($john->can('sites.delete.100'));
        $this->assertTrue($john->can('sites.edit.padoru'));
        $this->assertTrue($john->can('sites.create.000'));
        $this->assertTrue($john->can('sites.view.miku39'));

        // assert false
        $this->assertFalse($john->can('anotherresource.view.1'));
        $this->assertFalse($john->can('sites.anotheraction.aaaaaa'));
    }

    /**
     * User can only create one specific site.
     *
     * @return void
     */
    public function testUserHasPermissionToOnlyCreateOneSite()
    {
        $john = User::factory()->create();
        $site1 = Site::factory()->create();
        $site2 = Site::factory()->create();

        Permission::create(['name' => "sites.create.{$site1->id}"]);
        $john->givePermissionTo("sites.create.{$site1->id}");
        $this->assertTrue($john->can("sites.create.{$site1->id}"));

        $this->assertFalse($john->can("sites.create.{$site2->id}"));
        $this->assertFalse($john->can("sites.edit.{$site1->id}"));
        $this->assertFalse($john->can("sites.create.{$site2->id}"));
        $this->assertFalse($john->can('sites.view'));
    }

    /**
     * User can do anything because is a super admin
     *
     * @return void
     */
    public function testAdminHasPermissionToEverything()
    {
        $john = User::factory()->create();

        $site1 = Site::factory()->create();
        Permission::create(['name' => "sites.create.{$site1->id}"]);
        Role::create(['name' => 'Super Admin']);
        $john->assignRole('Super Admin');

        $this->actingAs($john);
        $response = $this->get(route('sites.index'));
        $response->assertOk();

        $this->assertTrue($john->can("sites.create.{$site1->id}"));
        $this->assertTrue($john->can("sites.edit.{$site1->id}"));
        $this->assertTrue($john->can('sites.view'));
    }

    public function testSiteOwnerHasAccessToCreateSitesForm()
    {
        $role_name = 'site owner';
        $role = Role::create(['name' => $role_name]);

        $permission = Permission::create(['name' => 'site.create']);
        $role->givePermissionTo($permission);

        $nico_owner = User::factory()->create();
        $nico_owner->assignRole($role_name);

        $this->actingAs($nico_owner);
        $response = $this->get(route('sites.create'));
        $response->assertOk();
    }
}
