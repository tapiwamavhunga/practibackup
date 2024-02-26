<?php

namespace Tests\Unit\Policies;

use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class UsersPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_users()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Users));
    }

    /** @test */
    public function user_can_view_users()
    {
        $user = $this->createUser();
        $users = Users::factory()->create();
        $this->assertTrue($user->can('view', $users));
    }

    /** @test */
    public function user_can_update_users()
    {
        $user = $this->createUser();
        $users = Users::factory()->create();
        $this->assertTrue($user->can('update', $users));
    }

    /** @test */
    public function user_can_delete_users()
    {
        $user = $this->createUser();
        $users = Users::factory()->create();
        $this->assertTrue($user->can('delete', $users));
    }
}
