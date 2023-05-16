<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $data = [];

        if(branch()) {
            $data['organization_id'] = branch()->organization_id;
            $data['branch_id'] = branch()->id;
        }

        $this->merge($data);

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
            'cpf_cnpj' => 'required',
            'type' => 'required',
            'contact' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ];
    }
}
