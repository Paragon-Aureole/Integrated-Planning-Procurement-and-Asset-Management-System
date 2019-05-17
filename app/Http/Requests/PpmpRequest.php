<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PpmpRequest extends FormRequest
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
            'ppmp_year' => 'required|date_format:Y',
            'office_id' => 'required'
        ];
    }

    public function messages() { 
        $messages = [
            'ppmp_year.date_format' => 'Invalid PPMP Year!',
        ];

        return $messages; 
      
  }
}
