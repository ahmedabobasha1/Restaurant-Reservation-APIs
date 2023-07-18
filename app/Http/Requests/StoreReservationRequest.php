<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            "table_id" => ['required'],
            "customer_id" => ['required'],
            "from_time" => ['required','date'],
            "to_time" => ['required','date','after:from_time'],
            "num_guests" => ['required','numeric'],
            
        ];
    }
}
