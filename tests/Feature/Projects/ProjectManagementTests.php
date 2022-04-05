<?php

namespace Tests\Feature\Projects;

use App\Models\Site;
use App\Models\User;
use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectManagementTests extends TestCase
{
    use WithFaker, RefreshDatabase;
    //php artisan test tests/Feature/Projects/ProjectManagementTests.php//

    public function test_guests_can_not_access_any_of_the_projects_routes()
    {
        //$this->withoutExceptionHandling();

        $attributes = Project::factory()->raw();

        $this->get('/projects')->assertRedirect('login');

        $this->get('/projects/create')->assertRedirect('login');

        $this->post('/projects', $attributes)->assertRedirect(('login'));
    }

    
    public function test_authenticated_users_can_view_project_pages()
    {
        $this->actingAs(User::factory()->create());

        $this->get('projects')->assertStatus(200);

        $this->get('/projects/create')->assertStatus(200);
    }

    public function test_saved_sites_and_users_are_loaded_with_the_create_project_page()
    {
        $this->actingAs(User::factory()->create());

        $site = Site::factory()->create();
        $user = User::factory()->create();

        $this->get('/projects/create')->assertSee([$site['site_name'], $user['name']]);

    }

    public function test_authenticated_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw();
        $attributes['sites'] = [1,2,3];
        $attributes['managers'] = [1,2,3];


        $this->post('/projects', $attributes)->assertRedirect('/projects');
    }

    public function test_project_requires_a_name_a_description_and_include_screening_fields()
    {
        $this->actingAs(User::factory()->create());

        $attributes['sites'] = [1,2,3];
        $attributes['managers'] = [1,2,3];

        $this->post('/projects', $attributes)->assertSessionHasErrors('name');
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
        $this->post('/projects', $attributes)->assertSessionHasErrors('include_screening');
    }

    public function test_project_requires_assigned_sites_and_managers()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertSessionHasErrors('sites');
        $this->post('/projects', $attributes)->assertSessionHasErrors('managers');
    }

    public function test_if_include_screening_is_yes_break_screening_is_required()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw([
            'include_screening' => 'Yes',
            'break_screening' => null
        ]);
        $attributes['sites'] = [1,2,3];
        $attributes['managers'] = [1,2,3];

        $this->post('/projects', $attributes)->assertSessionHasErrors('break_screening');
    }

    public function test_if_break_screening_is_yes_visit_labels_are_required()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw([
            'include_screening' => 'Yes',
            'break_screening' => 'Yes',
            'screening_visit_labels' => [0 => null],
        ]);
        $attributes['sites'] = [1,2,3];
        $attributes['managers'] = [1,2,3];

        $this->post('/projects', $attributes)->assertSessionHasErrors('screening_visit_labels.0');
    }

    public function test_duplicate_project_names_are_not_allowed()
    {
        $this->actingAs(User::factory()->create());

        $projectOne = Project::factory()->create();

        $projectTwo = Project::factory()->raw(['name' => $projectOne->name]);
        $projectTwo['sites'] = [1,2,3];
        $projectTwo['managers'] = [1,2,3];

        $this->post('/projects', $projectTwo)->assertSessionHas('error_message');
    }

    public function test_updated_by_is_added_on_project_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $attributes = Project::factory()->raw();
        $attributes['sites'] = [1,2];
        $attributes['managers'] = [1,2];

        $this->post('/projects', $attributes);
        $this->assertDatabaseHas('projects', ['updated_by' => $user->username]);
    }

    
    public function test_database_stores_managers_and_sites_when_project_is_created()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw();
        $attributes['sites'] = [1,2];
        $attributes['managers'] = [1,2];

        $this->post('/projects', $attributes);

        $this->assertDatabaseHas('project_sites', ['site_id' => 2]);
        $this->assertDatabaseHas('user_projects', ['user_id' => 1]);
    }

    //Check that selected sites actually exist

    //Check that project show can not be viewed by unauthenticated user

    //Check that project can not be viewed by unassigned authenticated user
    
}
