<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_name' => ['required', 'string', 'max:250'],
            'sku' => ['required', 'string', 'max:250'],
            'price' => ['required','min:1','numeric']            
        ];

        if( $this->product_image )
        {
            $rules['product_image'] = ['required','image','mimes:jpg,png,jpeg,gif,svg','max:2048'];
        }

        if( $this->sale_price != 0 )
        {
            $rules['sale_price'] = ['numeric','min:1'];
        }

        return $rules;
    }
}
