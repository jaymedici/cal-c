<?php

namespace Tests\Feature\Sites;

use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SiteManagementTests extends TestCase
{
    use WithFaker, RefreshDatabase;
    //php artisan test tests/Feature/Sites/SiteManagementTests.php//
   
    public function test_guests_can_not_access_any_of_the_site_routes()
    {
        $attributes = Site::factory()->raw();

        $this->get('/sites')->assertRedirect('login');

        $this->get('/sites/create')->assertRedirect('login');

        $this->post('/sites', $attributes)->assertRedirect(('login'));
    }

    public function test_authenticated_users_can_view_site_pages()
    {
        $this->actingAs(User::factory()->create());

        $this->get('sites')->assertStatus(200);

        $this->get('/sites/create')->assertStatus(200);
    }

    public function test_saved_users_are_loaded_with_the_create_site_page()
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $this->get('/sites/create')->assertSee([$user['name']]);
    }

    public function test_authenticated_user_can_create_a_site()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $attributes = Site::factory()->raw();
        $attributes['site_users'] = [1,2,3];

        $this->post('/sites', $attributes)->assertRedirect('/sites');
    }

    public function test_site_requires_a_site_name()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Site::factory()->raw(['site_name' => null]);
        $attributes['site_users'] = [1,2,3];

        $this->post('/sites', $attributes)->assertSessionHasErrors('site_name');
    }

    public function test_site_requires_site_users()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Site::factory()->raw();

        $this->post('/sites', $attributes)->assertSessionHasErrors('site_users');
    }

    public function test_site_with_duplicate_site_name_can_not_be_created()
    {
        $this->actingAs(User::factory()->create());

        $siteOne = Site::factory()->create();

        $siteTwo = Site::factory()->raw(['site_name' => $siteOne->site_name]);
        $siteTwo['site_users'] = [1,2,3];

        $this->post('/sites', $siteTwo)->assertSessionHasErrors('site_name');
    }

    public function test_updated_by_is_added_on_site_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $attributes = Site::factory()->raw();
        $attributes['site_users'] = [1,2];

        $this->post('/sites', $attributes);
        $this->assertDatabaseHas('sites', ['updated_by' => $user->username]);
    }

    public function test_database_stores_site_users_when_site_is_created()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $attributes = Site::factory()->raw();
        $attributes['site_users'] = [1,2];

        $this->post('/sites', $attributes);

        $this->assertDatabaseHas('user_sites', ['user_id' => 2]);
    }

    //Check that Selected Users actuallty exist

}
