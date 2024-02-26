<?php

namespace Tests\Feature;

use App\Models\Users;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_users_list_in_users_index_page()
    {
        $users = Users::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('users.index');
        $this->see($users->title);
    }

    /** @test */
    public function user_can_create_a_users()
    {
        $this->loginAsUser();
        $this->visitRoute('users.index');

        $this->click(__('users.create'));
        $this->seeRouteIs('users.index', ['action' => 'create']);

        $this->submitForm(__('app.create'), [
            'title'       => 'Users 1 title',
            'description' => 'Users 1 description',
        ]);

        $this->seeRouteIs('users.index');

        $this->seeInDatabase('users', [
            'title'       => 'Users 1 title',
            'description' => 'Users 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Users 1 title',
            'description' => 'Users 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_users_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('users.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_users_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('users.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_users_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('users.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_users_within_search_query()
    {
        $this->loginAsUser();
        $users = Users::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('users.index', ['q' => '123']);
        $this->click('edit-users-'.$users->id);
        $this->seeRouteIs('users.index', ['action' => 'edit', 'id' => $users->id, 'q' => '123']);

        $this->submitForm(__('users.update'), [
            'title'       => 'Users 1 title',
            'description' => 'Users 1 description',
        ]);

        $this->seeRouteIs('users.index', ['q' => '123']);

        $this->seeInDatabase('users', [
            'title'       => 'Users 1 title',
            'description' => 'Users 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Users 1 title',
            'description' => 'Users 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_users_title_update_is_required()
    {
        $this->loginAsUser();
        $users = Users::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('users.update', $users), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_users_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $users = Users::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('users.update', $users), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_users_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $users = Users::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('users.update', $users), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_users()
    {
        $this->loginAsUser();
        $users = Users::factory()->create();
        Users::factory()->create();

        $this->visitRoute('users.index', ['action' => 'edit', 'id' => $users->id]);
        $this->click('del-users-'.$users->id);
        $this->seeRouteIs('users.index', ['action' => 'delete', 'id' => $users->id]);

        $this->seeInDatabase('users', [
            'id' => $users->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('users', [
            'id' => $users->id,
        ]);
    }
}
