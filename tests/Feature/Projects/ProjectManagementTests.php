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
        dd($attributes);

        $this->post('/projects', $attributes)->assertRedirect('/projects');

    }

    //name, description and screening visit are mandatory

    //Check if it permits to create duplicate projects

    //participating sites and project managers are mandatory

    //if screening visit is yes, visit labels qn is mandatory

    //if visit labels qn is yes, screening visit  labels should be filled

    //Duplicate projects can not be stored
}
