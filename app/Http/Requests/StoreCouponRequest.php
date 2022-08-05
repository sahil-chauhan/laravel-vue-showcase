<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'coupon_code' => ['required', 'string', 'max:250','unique:coupons'],
            'discount' => ['required','min:0','numeric'],
            'type' => ['required'],
            'product_ids' => [],
        ];
    }
}
