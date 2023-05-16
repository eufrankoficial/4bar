<?php

namespace App\Http\Requests\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequestPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(branch() && !current_user()->hasRole('SuperAdmin')) {
            $this->merge([
                'organization_id' => branch()->organization_id,
            ]);
        }

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
            'organization_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
    }
}
