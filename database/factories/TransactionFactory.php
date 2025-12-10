<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['income', 'expense']);

        // More realistic amounts based on type
        if ($type === 'income') {
            $amount = fake()->randomFloat(2, 500, 5000); // Income typically higher
        } else {
            $amount = fake()->randomFloat(2, 10, 1000); // Expenses vary widely
        }

        return [
            'type' => $type,
            'amount' => $amount,
            'description' => fake()->optional(0.7)->sentence(6),
            'transcript' => null,
            'audio_file_path' => null,
            'ai_confidence_score' => null,
            'manually_edited' => false,
            'transaction_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'workspace_id' => Workspace::factory(),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the transaction is income.
     */
    public function income(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'income',
            'amount' => fake()->randomFloat(2, 500, 5000),
        ]);
    }

    /**
     * Indicate that the transaction is an expense.
     */
    public function expense(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'expense',
            'amount' => fake()->randomFloat(2, 10, 1000),
        ]);
    }

    /**
     * Indicate that the transaction was created via voice.
     */
    public function voice(): static
    {
        return $this->state(fn(array $attributes) => [
            'transcript' => fake()->sentence(10),
            'ai_confidence_score' => fake()->randomFloat(2, 0.7, 1.0),
        ]);
    }

    /**
     * Indicate that the transaction was manually edited.
     */
    public function edited(): static
    {
        return $this->state(fn(array $attributes) => [
            'manually_edited' => true,
        ]);
    }
}
