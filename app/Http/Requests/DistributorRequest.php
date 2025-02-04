<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistributorRequest extends FormRequest
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
            'distributor_name' => 'required|string|max:180',
            'distributor_address' => 'required|string|max:180',
            'distributor_certificate' => 'required|file|mimetypes:application/pdf',
        ];
    }
}
