<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['income', 'expense']);

        $incomeIcons = ['💵', '💼', '📈', '🎁', '💰'];
        $expenseIcons = ['🍽️', '🛒', '🛍️', '🏠', '🚗', '📄', '🎬', '⚕️', '📚', '✈️'];

        $incomeColors = ['#10B981', '#34D399', '#059669', '#6EE7B7', '#A7F3D0'];
        $expenseColors = ['#EF4444', '#F87171', '#FB923C', '#DC2626', '#F59E0B'];

        return [
            'name' => fake()->words(2, true),
            'name_ar' => null,
            'name_en' => null,
            'type' => $type,
            'icon' => $type === 'income' ? fake()->randomElement($incomeIcons) : fake()->randomElement($expenseIcons),
            'color' => $type === 'income' ? fake()->randomElement($incomeColors) : fake()->randomElement($expenseColors),
            'is_default' => false,
            'workspace_id' => Workspace::factory(),
        ];
    }

    /**
     * Indicate that the category is for income.
     */
    public function income(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'income',
        ]);
    }

    /**
     * Indicate that the category is for expenses.
     */
    public function expense(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'expense',
        ]);
    }

    /**
     * Indicate that the category is a default category.
     */
    public function default(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_default' => true,
        ]);
    }
}
