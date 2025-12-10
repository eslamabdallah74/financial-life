<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Category;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    protected $model = Budget::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = fake()->randomFloat(2, 100, 2000);

        return [
            'name' => fake()->words(3, true) . ' Budget',
            'name_ar' => null,
            'amount' => $amount,
            'alert_threshold' => fake()->randomFloat(2, 70, 90), // 70-90% threshold
            'period' => fake()->randomElement(['monthly', 'yearly']),
            'month' => fake()->numberBetween(1, 12),
            'year' => now()->year,
            'workspace_id' => Workspace::factory(),
            'category_id' => Category::factory()->expense(),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the budget is monthly.
     */
    public function monthly(): static
    {
        return $this->state(fn(array $attributes) => [
            'period' => 'monthly',
            'month' => now()->month,
        ]);
    }

    /**
     * Indicate that the budget is yearly.
     */
    public function yearly(): static
    {
        return $this->state(fn(array $attributes) => [
            'period' => 'yearly',
            'month' => null,
        ]);
    }
}
