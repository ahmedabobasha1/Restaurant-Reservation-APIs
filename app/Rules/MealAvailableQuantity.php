<?php

namespace App\Rules;

use App\Models\Meal;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MealAvailableQuantity implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
        public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $meals = request()->get('meals');

        foreach($meals as $meal){
            $mealObj = Meal::find($meal['id']);
            if($mealObj->quantity_available < $meal['quantity']){
                $fail("The selected {$attribute}.quantity is invalid.")->toString();
                continue;
            }
        }
    }
}
