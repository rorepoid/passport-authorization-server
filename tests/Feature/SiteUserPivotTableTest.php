<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SiteUserPivotTableTest extends TestCase
{
    use RefreshDatabase;

    public function testNewUserDoesNotBelongToAnySite()
    {
        $user = User::factory()->create();
        $this->assertEmpty($user->sites);
    }

    /** TODO
     * See this https://github.com/rorepoid/passport-authorization-server/issues/39
     */
    // public function testNewSiteDoesNotBelongToAnyUser()
    // {
    //     $site = Site::factory()->create();
    //     $this->assertEmpty($site->users);
    // }

    public function testUserCanBelongsToManySites()
    {
        $user = User::factory()->create();
        $site1 = Site::factory()->create();
        $site2 = Site::factory()->create();


        // TODO https://github.com/rorepoid/passport-authorization-server/issues/39
        // $this->assertEmpty($site1->users);
        // $this->assertEmpty($site2->users);
        // $this->assertEmpty($user->sites);

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

        $new_user = User::factory()->create();
        $this->assertFalse(($site1->users)->contains($new_user));
        $this->assertFalse(($site2->users)->contains($new_user));
    }

    public function testSiteCanBelongsToManyUsers()
    {
        $site = Site::factory()->create();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // TODO https://github.com/rorepoid/passport-authorization-server/issues/39
        // $this->assertEmpty($user1->sites);
        // $this->assertEmpty($user2->sites);
        // $this->assertEmpty($site->users);

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

        $new_site = Site::factory()->create();
        $this->assertFalse(($user1->sites)->contains($new_site));
        $this->assertFalse(($user2->sites)->contains($new_site));
    }
}
