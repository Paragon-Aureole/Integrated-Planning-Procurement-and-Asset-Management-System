<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
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
            'office_code' => 'required|string|max:10|unique:offices,office_code,' . $this->id,
            'office_name' => 'required|string|max:180|unique:offices,office_name,' . $this->id,
            'category' => 'required|numeric',
        ];
    }
}
