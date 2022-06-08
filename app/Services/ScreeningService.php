<?php

namespace App\Services;

use App\Models\Screening;
use Auth;

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
        return Screening::whereProjectAssignedTo($userId);
    }
}