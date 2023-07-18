<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meal extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function orderDetails(){
        return $this->hasMany(OrderDetails::class);
    }
}
