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

    public function testSiteCanBelongsToManyUsers()
    {
        $site = factory(Site::class)->create();
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->assertEmpty($user1->sites);
        $this->assertEmpty($user2->sites);
        $this->assertEmpty($site->users);

        // associate realtions
        $site->users()->saveMany([
            $user1, $user2
        ]);
        $site = $site->fresh();
        $user1 = $user1->fresh();
        $user2 = $user2->fresh();

        $this->assertTrue(($site->users)->contains($user1));
        $this->assertTrue(($site->users)->contains($user2));
        $this->assertTrue(($user1->sites)->contains($site));
        $this->assertTrue(($user2->sites)->contains($site));

        $new_site = factory(Site::class)->create();
        $this->assertFalse(($user1->sites)->contains($new_site));
        $this->assertFalse(($user2->sites)->contains($new_site));
    }
}
