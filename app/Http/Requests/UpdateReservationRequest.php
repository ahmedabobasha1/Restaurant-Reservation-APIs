<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "table_id" => ['required','numeric'],
            "customer_id" => ['required','numeric'],
            "from_time" => ['required','date'],
            "to_time" => ['required','date'],
            "num_guests" => ['required','numeric'],
           
        ];
    }
}
