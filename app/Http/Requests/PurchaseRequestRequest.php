<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequestRequest extends FormRequest
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
            'pr_code' => 'required|string|max:185',
            'pr_purpose' => 'required|string|max:185',
            'supplier_type' => 'required',
            'pr_requestor' => 'required|numeric',
            'pr_budget' => 'required'
        ];
    }
}
