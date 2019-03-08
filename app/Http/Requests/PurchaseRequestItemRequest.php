<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequestItemRequest extends FormRequest
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
            "item_description" => 'required|numeric',
            "item_quantity" => 'required|numeric',
            "item_cpu" => 'required|string',
            "item_cpi" => 'required|numeric'
        ];
    }
}
