<?php

namespace Tests\Feature\Screening;

use App\Models\Site;
use App\Models\User;
use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScreenPatientTest extends TestCase
{
    //php artisan test tests/Feature/Screening/ScreenPatientTest.php
    use WithFaker, RefreshDatabase;

    public function test_all_required_fields_are_filled()
    {
        $this->actingAs(User::factory()->create());

        $attributes = [];

        $this->post('/screening', $attributes)->assertSessionHasErrors([
            'project_id', 'screening_label', 'screening_date', 'screening_outcome',
            'participant_type'
        ]);
    }

    public function test_participant_id_is_required_if_participant_type_is_new()
    {
        $this->actingAs(User::factory()->create());

        $attributes = [
            'project_id' => 1,
            'screening_label' => 'Screening',
            'screening_date' => '2022-03-01',
            'screening_outcome' => 'Enrol',
            'participant_type' => 'New',
            'participant_id' => null
        ];

        $this->post('/screening', $attributes)->assertSessionHasErrors(['participant_id']);
    }

    public function test_participant_id_select_is_required_if_participant_type_is_returning()
    {
        $this->actingAs(User::factory()->create());

        $attributes = [
            'project_id' => 1,
            'screening_label' => 'Screening',
            'screening_date' => '2022-03-01',
            'screening_outcome' => 'Enrol',
            'participant_type' => 'Returning',
            'participant_id_select' => null
        ];

        $this->post('/screening', $attributes)->assertSessionHasErrors(['participant_id_select']);
    }

    public function test_next_screening_date_is_required_if_screening_outcome_is_continue_screening()
    {
        $this->actingAs(User::factory()->create());

        $attributes = [
            'project_id' => 1,
            'screening_label' => 'Screening',
            'screening_date' => '2022-03-01',
            'screening_outcome' => 'Continue Screening',
            'participant_type' => 'New',
            'participant_id' => 'TEST'
        ];

        $this->post('/screening', $attributes)->assertSessionHasErrors(['next_screening_date']);
    }

    public function test_a_new_participant_is_not_assigned_with_an_existing_participant_id()
    {
        $this->actingAs(User::factory()->create());
        $project = Project::factory()->create();
        $site = Site::factory()->create(['id' => 1]);

        $attributes = [
            'project_id' => $project->id,
            'screening_label' => 'Screening',
            'screening_date' => '2022-03-01',
            'screening_outcome' => 'Enrol',
            'participant_type' => 'New',
            'participant_id' => 'TEST',
            'site_id' => $site->id
        ];

        $this->post('/screening', $attributes);

        $attributes2 = [
            'project_id' => $project->id,
            'screening_label' => 'Screening',
            'screening_date' => '2022-03-01',
            'screening_outcome' => 'Enrol',
            'participant_type' => 'New',
            'participant_id' => 'TEST',
            'site_id' => $site->id
        ];

        $this->post('/screening', $attributes2)->assertSessionHas(['error_message']);
    }

    public function test_new_patient_screening_data_is_stored_in_the_database()
    {
        $this->actingAs(User::factory()->create());
        $project = Project::factory()->create();
        $site = Site::factory()->create(['id' => 1]);

        $attributes = [
            'project_id' => $project->id,
            'screening_label' => 'Screening',
            'screening_date' => '2022-03-01',
            'screening_outcome' => 'Enrol',
            'participant_type' => 'New',
            'participant_id' => 'TEST',
            'site_id' => $site->id
        ];

        $this->post('/screening', $attributes);
        $this->assertDatabaseHas('screening', ['participant_id' => 'TEST']);
    }

    public function test_returning_patient_screening_data_is_stored_in_the_database()
    {
        $this->actingAs(User::factory()->create());
        $project = Project::factory()->create();
        $site = Site::factory()->create(['id' => 1]);

        $attributes = [
            'project_id' => $project->id,
            'screening_label' => 'Screening',
            'screening_date' => '2022-03-01',
            'screening_outcome' => 'Enrol',
            'participant_type' => 'Returning',
            'participant_id_select' => 'TEST',
            'site_id' => $site->id
        ];

        $this->post('/screening', $attributes);
        $this->assertDatabaseHas('screening', ['participant_id' => 'TEST']);
    }

    public function test_appointment_is_created_for_continue_screening_outcome()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $project = Project::factory()->create();
        $site = Site::factory()->create(['id' => 1]);

        $attributes = [
            'project_id' => $project->id,
            'screening_label' => 'Screening',
            'screening_date' => '2022-03-01',
            'screening_outcome' => 'Continue Screening',
            'participant_type' => 'Returning',
            'participant_id_select' => 'TEST',
            'site_id' => $site->id,
            'next_screening_date' => '2022-03-05'
        ];

        $this->post('/screening', $attributes);
        $this->assertDatabaseHas('appointments', ['participant_id' => 'TEST']);
    }
}
