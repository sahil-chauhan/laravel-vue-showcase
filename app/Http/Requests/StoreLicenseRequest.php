<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLicenseRequest extends FormRequest
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
            'account_id' => ['required','numeric'], 
            'product_id' => ['required','numeric'],
            'activation_limit' => ['required','numeric','min:1'] 
        ];
    }

    public function messages()
    {
        return [
            'account_id.required' => 'Please select the account.', 
            'product_id.required' => 'Please select the product.', 
            'activation_limit' => 'Please choose activation limits.',
        ];
    }
}
