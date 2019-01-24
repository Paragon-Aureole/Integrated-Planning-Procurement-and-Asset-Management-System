<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignatoryRequest extends FormRequest
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
            'signatory_name' => 'required|string|max:180',
            'signatory_position' => 'required|string|max:180',
            'office' => 'required|numeric',
        ];
    }
}
