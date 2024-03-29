<?php

namespace App\Http\Requests\Sites;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiteRequest extends FormRequest
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
            'site_name' => 'required|unique:sites',
            'district' => 'string|nullable',
            'region' => 'string|nullable',
            'country' => 'string|nullable',
            'site_users' => 'required',
        ];
    }
}
