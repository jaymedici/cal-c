<?php

namespace Tests\Feature\ParticipantVisits;

use App\Models\ParticipantVisit;
use App\Models\Site;
use App\Models\User;
use App\Models\VisitSetting;
use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnrolParticipantTest extends TestCase
{
    //php artisan test tests/Feature/ParticipantVisits/EnrolParticipantTest.php
    use WithFaker, RefreshDatabase;

    public function getAttributes()
    {
        $attributes = [
            'participant_id' => $this->faker->numerify('PNo/Test/####'),
            'site_id' => Site::factory()->create()->id,
            'first_visit_date' => $this->faker->dateTimeBetween('-2 weeks', '+10 weeks')
        ];

        return $attributes;
    }

    public function getProject()
    {
        $this->actingAs(User::factory()->create());
        return Project::factory()->create();
    }

    public function test_guests_cannot_access_participant_enrolment_pages()
    {
        $this->get('participantVisits/enrolmentIndex')->assertRedirect('login');
        $this->get('participantVisits/createParticipant/1')->assertRedirect('login');
    }

    public function test_authenticated_users_can_view_enrolment_index_page()
    {
        $this->actingAs(User::factory()->create());

        $this->get('participantVisits/enrolmentIndex')->assertStatus(200);
    }

    public function test_users_can_only_see_assigned_projects_on_enrolment_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $projectOne = Project::factory()->create();
        $projectTwo = Project::factory()->create(); 
        $visitSettingsForProjectOne = VisitSetting::factory()->create(['project_id' => $projectOne->id]);
        $visitSettingsForProjectTwo = VisitSetting::factory()->create(['project_id' => $projectTwo->id]);

        $projectOne->assignManagers([$user->id]);

        $this->get('participantVisits/enrolmentIndex')->assertSee([$projectOne->name]);
        $this->get('participantVisits/enrolmentIndex')->assertDontSee([$projectTwo->name]);
    }

    public function test_users_can_only_see_projects_with_visits_on_enrolment_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $projectOne = Project::factory()->create();
        $visitSettingsForProjectOne = VisitSetting::factory()->create(['project_id' => $projectOne->id]);
        $projectOne->assignManagers([$user->id]);

        $projectTwo = Project::factory()->create();
        $projectTwo->assignManagers([$user->id]);

        $this->get('participantVisits/enrolmentIndex')->assertSee([$projectOne->name]);
        $this->get('participantVisits/enrolmentIndex')->assertDontSee([$projectTwo->name]);
    }

    public function test_participant_id_site_id_and_first_visit_date_are_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::factory()->create();

        $attributes = [
            'participant_id' => null,
            'site_id' => null,
            'first_visit_date' => null
        ];

        $this->post('participantVisits/storeParticipant/' . $project->id, $attributes)
                ->assertSessionHasErrors(['participant_id', 'site_id', 'first_visit_date', 'mark_first_visit_complete']);

    }

    public function test_duplicate_participant_ids_are_not_allowed_on_enrolment()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::factory()->create();
        $visit = VisitSetting::factory()->create(['project_id' => $project->id]);
        $site = Site::factory()->create();
        
        $participantVisitSchedule = ParticipantVisit::factory()->create([
                                                                'project_id' => $project->id,
                                                                'visit_id' => $visit->id,
                                                                'site_id' => $site->id]);

        $attributes = [
            'participant_id' => $participantVisitSchedule->participant_id,
            'site_id' => Site::factory()->create()->id,
            'first_visit_date' => '2022-03-01',
            'mark_first_visit_complete' => 'Yes'
        ];

        $this->post('participantVisits/storeParticipant/' . $project->id, $attributes)
                ->assertSessionHas('error_message');
    }

    public function test_a_visit_schedule_can_be_generated_for_the_participant()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::factory()->create();
        $projectVisits = VisitSetting::factory()->count(5)->create(['project_id' => $project->id]);
        $site = Site::factory()->create();

        $attributes = [
            'participant_id' => 'VsTEST',
            'site_id' => $site->id,
            'first_visit_date' => '2022-03-01',
            'mark_first_visit_complete' => 'No'
        ];

        $this->post('participantVisits/storeParticipant/' . $project->id, $attributes);

        foreach($projectVisits as $projectVisit)
        {
            $this->assertDatabaseHas('participant_visits', ['visit_id' => $projectVisit->id]);
        }
    }

    
    //Check if mark_first_visit_complete works
    //test user can not store participant for non-existent project
    //test user can not store participant for a project not assigned
    //test user can not store participant for a project with no visits
      
}
