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
}
