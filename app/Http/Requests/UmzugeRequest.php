<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UmzugeRequest extends FormRequest
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

            //street name or address
            //the house number associated with the from_Strabe
            // "Landkreiszeichen" or "Landkreiscode" and may refer to a district or regional code.
            //the postal code associated with the from_Strabe
            // the city or locality associated with the from_Strabe
            //the living area in square meters
            // the number of rooms
            // the floor or level
            //the distance to carry items in meters
            // whether there is an elevator usable for moving
            //your_desired_moving_date_and_further_information

        ];
    }
}
