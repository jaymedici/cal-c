<?php

namespace App\Http\Requests\VisitSettings;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitsForProjectsRequest extends FormRequest
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
            'visit_1_label' => 'required',
            'visit_names' => 'required',
            'days_from_first_visit' => 'required',
            'plus_window_periods' => 'required',
            'minus_window_periods' => 'required'
        ];
    }
}
