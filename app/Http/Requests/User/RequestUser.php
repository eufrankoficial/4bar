<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RequestUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $data = [];

        if(branch() && !$this->get('branchs')) {
            $data['branchs'][] = branch()->id;
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
            'name' => 'required|min:3',
            'email' => 'required|unique:user,email,' . ($this->user ? $this->user->id : null),
            'role' => 'required',
            'branchs' => 'required',
            'password' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name is required'),
            'name.min' => __('Must be 3 caracters'),
            'password.min' => __('Must be 3 caracters'),
            'email.required'  => __('Email is required'),
            'email.unique' => __('Email already exists'),
            'password.required' => __('Password is required'),
            'role.required' => __('User group is required'),
            'branchs.required' => __('Branch is required')
        ];
    }
}
