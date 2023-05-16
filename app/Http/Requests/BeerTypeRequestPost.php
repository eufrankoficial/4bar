<?php

namespace App\Http\Requests;

use App\Models\BeerType;
use Illuminate\Foundation\Http\FormRequest;

class BeerTypeRequestPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(branch()) {

            $this->merge([
                'branch_id' => branch()->id,
                'organization_id' => branch()->organization_id,
                'status' => BeerType::STATUS_PENDING
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
            'name' => 'required'
        ];
    }
}
