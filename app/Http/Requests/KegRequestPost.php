<?php

namespace App\Http\Requests;

use App\Models\Keg;
use Illuminate\Foundation\Http\FormRequest;

class KegRequestPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $data = [];

        if(!$this->get('organization_id')) {
            $data['organization_id'] = branch()->organization_id;
            $data['branch_id'] = branch()->id;
        }

        if(is_null($this->get('volume_available'))) {
            $data['volume_available'] = $this->get('capacity');
        }

        if(is_null($this->get('inbound_datetime'))) {
            $data['inbound_datetime'] = now()->format('d/m/Y');
        }

        if(empty($this->get('status'))) {
            $data['status'] = Keg::FULL;
        }

        if(empty($this->keg)) {
            $data['last_synchronization'] = now();
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
            'branch_id' => 'required',
            'organization_id' => 'required',
            'beer_type_id' => 'required',
            'supplier_id' => 'required',
            'pin_keg' => 'required',
            'inbound_datetime' => 'required',
            'due_date' => 'required',
            'volume_available' => 'required',
            'status' => 'required',
            'capacity' => 'required'
        ];
    }
}
