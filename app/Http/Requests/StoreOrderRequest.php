<?php

namespace App\Http\Requests;

use App\Rules\MealAvailableQuantity;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            "reservation_id"  => ['required','numeric'],
            "customer_id" => ['required','numeric'],
            "waiter_id" => ['required','numeric'],
            'meals' => ['required','array'],
            'meals.*.id' => ['required','exists:meals,id'],
            'meals.*.quantity' => ['required','integer',new MealAvailableQuantity],
        ];
    }
}
