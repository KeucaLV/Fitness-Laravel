<?php

// database/factories/MealPlanFactory.php

namespace Database\Factories;

use App\Models\MealPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealPlanFactory extends Factory
{
    protected $model = MealPlan::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),  // Correct usage of faker
            'category' => $this->faker->randomElement(['weight loss', 'weight maintenance', 'weight gain']),
            'meal_time' => $this->faker->randomElement(['breakfast', 'lunch', 'dinner']),
            'calories' => $this->faker->numberBetween(200, 800),  // Random calories value
            // Add any other necessary fields
        ];
    }
}
