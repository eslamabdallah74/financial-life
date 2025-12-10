<?php

namespace Database\Factories;

use App\Models\SavingsGoal;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SavingsGoal>
 */
class SavingsGoalFactory extends Factory
{
    protected $model = SavingsGoal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $targetAmount = fake()->randomFloat(2, 1000, 50000);
        $currentAmount = fake()->randomFloat(2, 0, $targetAmount * 0.8); // Up to 80% progress

        $icons = ['🏖️', '🏠', '🚗', '💍', '📱', '💰', '🎓', '✈️', '🏥', '🎁'];
        $colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899', '#14B8A6'];

        return [
            'name' => fake()->words(3, true),
            'name_ar' => null,
            'description' => fake()->optional(0.7)->sentence(10),
            'target_amount' => $targetAmount,
            'current_amount' => $currentAmount,
            'deadline' => fake()->dateTimeBetween('now', '+2 years'),
            'status' => 'active',
            'icon' => fake()->randomElement($icons),
            'color' => fake()->randomElement($colors),
            'workspace_id' => Workspace::factory(),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the savings goal is completed.
     */
    public function completed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'current_amount' => $attributes['target_amount'],
                'status' => 'completed',
            ];
        });
    }

    /**
     * Indicate that the savings goal is paused.
     */
    public function paused(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'paused',
        ]);
    }

    /**
     * Indicate that the savings goal just started (low progress).
     */
    public function started(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'current_amount' => $attributes['target_amount'] * fake()->randomFloat(2, 0.05, 0.20),
            ];
        });
    }
}
