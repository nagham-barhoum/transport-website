<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //Content Person string
            //Company string
            //Number
            //Dimensions
            //wight
            //Goods Value
            //Goods Details
            //loading point
            //Subscription date
            //Delivery date
            //Unloading place
            // ملاحظات/الأوقات  marks/Times
        ];
    }
}
