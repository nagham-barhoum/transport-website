<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersUpdateRequest extends FormRequest
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
            'order_id' => 'integer|required',
            'type' =>'integer|required',
            'status' => 'integer|required|in:1,2',
            'approved_date'=>'required|date',
            'contract_number' => 'integer|required',
            'file'=>'file|mimes:pdf'
        ];
    }
}
