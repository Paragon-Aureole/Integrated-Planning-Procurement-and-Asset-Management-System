<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MeasurementUnitRequest extends FormRequest
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


            'unit_code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('measurement_units')->ignore($this->id),
            ],
            'unit_description' => [
                'required',
                'string',
                'max:180',
                Rule::unique('measurement_units')->ignore($this->id),
            ],
            
        ];
    }
}
