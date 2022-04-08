<?php

namespace Tests\Feature\VisitSettings;

use App\Models\User;
use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VisitSettingManagementTest extends TestCase
{
    //php artisan test tests/Feature/VisitSettings/VisitSettingManagementTest.php
    use WithFaker, RefreshDatabase;

    public $mockFormAttributes = [
        'visit_1_label' => 'Baseline',
        'visit_names' => array('Week 1', 'Week 2', 'Week 3', 'Week Zeus', 'TC1'),
        'days_from_first_visit' => array('7', '14', '21', '28', '100'),
        'plus_window_periods' => array('2', '2', '1', '3', '30'),
        'minus_window_periods' => array('2', '2', '1', '3', '30'),
    ];

    
    public function test_user_not_assigned_to_project_cannot_view_visit_settings_creation_form()
    {
        $this->actingAs(User::factory()->create());

        $createdProject = Project::factory()->create();

        $this->get('/visits/createForProject/' . $createdProject->id)->assertStatus(403);
    }

    public function test_assigned_project_user_can_view_visit_settings_creation_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $createdProject = Project::factory()->create();
        $createdProject->assignManagers([$user->id]);

        $this->get('/visits/createForProject/' . $createdProject->id)->assertStatus(200);
    }

    public function test_project_is_loaded_with_visit_settings_creation_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $createdProject = Project::factory()->create();
        $createdProject->assignManagers([$user->id]);

        $this->get('/visits/createForProject/' . $createdProject->id)->assertSee($createdProject->name);
    }

    public function test_visit_settings_are_stored_in_the_database()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        $createdProject = Project::factory()->create();
        $createdProject->assignManagers([$user->id]);

        $this->post('/visits/storeVisitsForProject/' . $createdProject->id, $this->mockFormAttributes)->assertRedirect('/visits');
        $this->assertDatabaseHas('visit_settings', ['visit_name' => 'Week Zeus']);
    }

    public function test_visit_settings_form_validation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $createdProject = Project::factory()->create();
        $createdProject->assignManagers([$user->id]);

        $this->post('/visits/storeVisitsForProject/' . $createdProject->id, [])
            ->assertSessionHasErrors(['visit_1_label', 'visit_names', 'days_from_first_visit',
                                        'plus_window_periods', 'minus_window_periods']);
    }
}
