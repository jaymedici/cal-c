<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'include_screening' => 'required',
            'sites' => 'required',
            'managers' => 'required',
            'break_screening' => 'required_if:include_screening,==,Yes',
            'screening_visit_labels.*' => 'required_if:break_screening,==,Yes',
        ];
    }
}
