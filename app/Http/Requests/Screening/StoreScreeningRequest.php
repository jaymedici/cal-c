<?php

namespace App\Http\Requests\Screening;

use Illuminate\Foundation\Http\FormRequest;

class StoreScreeningRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required',
            'screening_label' => 'required',
            'screening_date' => 'required',
            'screening_outcome' => 'required',
            'participant_type' => 'required',
            'participant_id' => 'required_if:participant_type,==,New',
            'participant_id_select' => 'required_if:participant_type,==,Returning',
            'next_screening_date' => 'required_if:screening_outcome,==,Continue Screening',
        ];
    }
}
