<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'meal_plans';

    // Fields that can be mass-assigned
    protected $fillable = [
        'name',
        'recipe',
        'calories',
        'protein',
        'fats',
        'category',
        'meal_time',
    ];
}
