<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcurementMethodRequest extends FormRequest
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
            'method_name' => 'required|string|max:180|unique:procurement_modes,method_name,'. $this->id,
            'method_code' => 'required|string|max:180|unique:procurement_modes,method_code,'. $this->id,
        ];
    }
}
