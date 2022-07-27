<?php

namespace App\Http\Controllers;

use App\Models\EnrolledParticipant;
use App\Project;
use Illuminate\Http\Request;

class EnrolledParticipantsController extends Controller
{
    public function enrolledParticipantsIndex($projectId)
    {
        $project = Project::findOrFail($projectId);
        return view('participants.enrolledParticipantsIndex', compact('project'));
    }

}
