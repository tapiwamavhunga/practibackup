<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_users_has_title_link_attribute()
    {
        $users = Users::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $users->title, 'type' => __('users.users'),
        ]);
        $link = '<a href="'.route('users.show', $users).'"';
        $link .= ' title="'.$title.'">';
        $link .= $users->title;
        $link .= '</a>';

        $this->assertEquals($link, $users->title_link);
    }

    /** @test */
    public function a_users_has_belongs_to_creator_relation()
    {
        $users = Users::factory()->make();

        $this->assertInstanceOf(User::class, $users->creator);
        $this->assertEquals($users->creator_id, $users->creator->id);
    }
}
