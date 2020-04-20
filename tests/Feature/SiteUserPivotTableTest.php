<?php

namespace Tests\Feature;

use App\User;
use App\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SiteUserPivotTableTest extends TestCase
{
    use RefreshDatabase;

    public function testNewUserDoesNotBelongToAnySite()
    {
        $user = factory(User::class)->create();
        $this->assertEmpty($user->sites);
    }

    public function testNewSiteDoesNotBelongToAnyUser()
    {
        $site = factory(Site::class)->create();
        $this->assertEmpty($site->users);
    }

    public function testUserCanBelongsToManySites()
    {
        $user = factory(User::class)->create();
        $site1 = factory(Site::class)->create();
        $site2 = factory(Site::class)->create();

        $this->assertEmpty($site1->users);
        $this->assertEmpty($site2->users);
        $this->assertEmpty($user->sites);

        // associate realtions
        $user->sites()->saveMany([
            $site1, $site2
        ]);
        $user = $user->fresh();
        $site1 = $site1->fresh();
        $site2 = $site2->fresh();

        $this->assertTrue(($user->sites)->contains($site1));
        $this->assertTrue(($user->sites)->contains($site2));
        $this->assertTrue(($site1->users)->contains($user));
        $this->assertTrue(($site2->users)->contains($user));

        $new_user = factory(User::class)->create();
        $this->assertFalse(($site1->users)->contains($new_user));
        $this->assertFalse(($site2->users)->contains($new_user));
    }
}
