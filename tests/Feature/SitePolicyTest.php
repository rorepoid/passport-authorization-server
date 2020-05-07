<?php

namespace Tests\Feature;

use App\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SitePolicyTest extends TestCase
{
    /** @test */
    function admins_can_update_sites()
    {
        //Arrange
        $admin = $this->createAdmin();

        $this->be($admin);

        $post = new Site;

        // Act
        $result = Gate::allows('update-site', $post);

        // Assert
        $this->assertTrue($result);
    }
}
