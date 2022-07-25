<?php

namespace App\Services;

use App\Models\Screening;
use App\Project;
use Auth;
use Illuminate\Support\Facades\Validator;

class ScreeningService {

    public function duplicatePatientExists($patientData)
    {
        if($patientData['participant_type'] == "New")
        {
            $participant = Screening::where('participant_id', $patientData['participant_id'])
                                            ->where('project_id', $patientData['project_id'])
                                            ->count();

            if($participant > 0)
            {
                return true;
            }
        }
    }

    public function fillRemainingPatientData($patientData)
    {
        if($patientData['participant_type'] == "Returning")
        {
            $patientData['participant_id'] = $patientData['participant_id_select'];
        }
        
        if($patientData['screening_outcome'] == "Continue Screening")
        {
            $patientData['still_screening'] = "Yes";
        }
        else
        {
            $patientData['next_screening_date'] = null;
            $patientData['still_screening'] = "No";
        }
        
        $patientData['updated_by'] = Auth::user()->username;
        
        return $patientData;
    }

    public function getAllScreenings($userId)
    {
        return Screening::whereProjectAssignedTo($userId)->get();
    }

    public function screeningRecords($userId)
    {
        return Screening::whereProjectAssignedTo($userId)
                        ->whereSiteAssignedTo($userId);
    }

    public function getScreeningLabels($projectId)
    {
        $project = Project::findOrFail($projectId);
        $screeningVisitLabels = array_filter(explode(';', $project->screening_visit_labels));
        
        return $screeningVisitLabels;
    }

    public function getReturningParticipantIds($projectId)
    {
        $participantIdsWithContinueScreening =  Screening::where('project_id', $projectId)
                                            ->whereSiteAssignedTo(auth()->id())
                                            ->where('screening_outcome', 'LIKE', 'Continue Screening')
                                            ->get()->unique('participant_id')
                                            ->pluck('participant_id')
                                            ->toArray();

        $returningParticipantIds = $this->filterOutEnroledOrFailedParticipants(
                                    $projectId, $participantIdsWithContinueScreening);

        return $returningParticipantIds;
    }

    public function filterOutEnroledOrFailedParticipants(int $projectId, array $participantIds)
    {
        $projectScreeningRecords = Screening::where('project_id', $projectId)->get();

        foreach($projectScreeningRecords as $screeningRecord)
        {
            if($screeningRecord->screening_outcome == "Enrol" | $screeningRecord->screening_outcome == "Screen Failure")
            {
                $keyToUnset = array_search($screeningRecord->participant_id, $participantIds);
                unset($participantIds[$keyToUnset]);
            }
        }

        return $participantIds;
    }

    public function validateScreeningRecordUpdates(array $screningDetails)
    {
        return Validator::make($screningDetails, [
            'participant_id' => 'required',
            'screening_label' => 'required',
            'screening_date' => 'required',
            'still_screening' => 'required',
            'screening_outcome' => 'required'
            ])
            ->validate();
    }
}