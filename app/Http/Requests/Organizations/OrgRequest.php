<?php

namespace App\Http\Requests\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class OrgRequest extends FormRequest
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
            'name' => 'required|min:3',
            'administrator_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'administrator_id.required'  => 'Escolha um administrador',
            'administrator_id.integer'  => '',
        ];
    }
}
