<?php

namespace Tests\Feature;

use App\User;
use App\Site;
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
        $john = factory(User::class)->create();

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
        $john = factory(User::class)->create();
        $site1 = factory(Site::class)->create();
        $site2 = factory(Site::class)->create();

        Permission::create(['name' => "sites.create.{$site1->id}"]);
        $john->givePermissionTo("sites.create.{$site1->id}");
        $this->assertTrue($john->can("sites.create.{$site1->id}"));

        $this->assertFalse($john->can("sites.create.{$site2->id}"));
        $this->assertFalse($john->can("sites.edit.{$site1->id}"));
        $this->assertFalse($john->can("sites.create.{$site2->id}"));
        $this->assertFalse($john->can('sites.view'));
    }
}
