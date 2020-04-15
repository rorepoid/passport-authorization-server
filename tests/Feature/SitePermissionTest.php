<?php

namespace Tests\Feature;

use App\User;
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
}
