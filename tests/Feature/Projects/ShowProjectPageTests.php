<?php

namespace Tests\Feature\Projects;

use App\Models\User;
use App\Project;
use App\Services\ReportsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowProjectPageTests extends TestCase
{
    //Check that the visit outcome chart is loaded
    public function test_visit_outcome_chart_is_Loaded()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create();
        
        
    }

    //Check that info box variables are loaded

    //Check that Quick stat variables are loaded

    //Check that registered users are loaded

    //Check that assigned users are loaded
}
