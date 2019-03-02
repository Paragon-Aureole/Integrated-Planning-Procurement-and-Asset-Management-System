<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PpmpItemRequest extends FormRequest
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
        $rules = [
            'item_code' => 'required',
            'item_description' => 'required|string|max:185',
            'item_mode' => 'required',
            'item_quantity' => 'required|numeric',
            'item_unit' => 'required',
            'item_cost' => 'required|numeric',
            'item_budget' => 'required|numeric',
        ];

        foreach($this->request->get('item_schedule') as $key => $val) { 
            $rules['item_schedule.'.$key] = 'required|numeric'; 
        }

        return $rules;
    }

    public function messages() { 
      $messages = [
        'item_budget.required' => 'Item Budget is required.',
        'item_budget.numeric' => 'Item Budget must be numeric.',
      ]; 

      foreach($this->request->get('item_schedule') as $key => $val) { 
        $messages['item_schedule.'.$key.'.required'] = 'Schedule is required.';
        $messages ['item_schedule.'.$key.'.numeric'] = 'Schedule must be numeric.';
      } 
      return $messages; 
    }
}

