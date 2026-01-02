<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Workspace;
use App\Models\Category;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Create default workspace for the user
        $workspace = Workspace::create([
            'name' => 'Personal Workspace',
            'owner_id' => $user->id,
        ]);

        // Seed default categories for the new user
        $defaultCategories = [
            // Income categories
            ['name' => 'Salary', 'type' => 'income', 'icon' => '💰', 'color' => '#10b981'],
            ['name' => 'Freelance', 'type' => 'income', 'icon' => '💼', 'color' => '#3b82f6'],
            ['name' => 'Investments', 'type' => 'income', 'icon' => '📈', 'color' => '#8b5cf6'],
            ['name' => 'Gifts', 'type' => 'income', 'icon' => '🎁', 'color' => '#ec4899'],

            // Expense categories
            ['name' => 'Food & Dining', 'type' => 'expense', 'icon' => '🍔', 'color' => '#ef4444'],
            ['name' => 'Transportation', 'type' => 'expense', 'icon' => '🚗', 'color' => '#f59e0b'],
            ['name' => 'Shopping', 'type' => 'expense', 'icon' => '🛍️', 'color' => '#ec4899'],
            ['name' => 'Entertainment', 'type' => 'expense', 'icon' => '🎬', 'color' => '#8b5cf6'],
            ['name' => 'Bills & Utilities', 'type' => 'expense', 'icon' => '⚡', 'color' => '#f59e0b'],
            ['name' => 'Healthcare', 'type' => 'expense', 'icon' => '🏥', 'color' => '#ef4444'],
            ['name' => 'Education', 'type' => 'expense', 'icon' => '📚', 'color' => '#3b82f6'],
            ['name' => 'Travel', 'type' => 'expense', 'icon' => '✈️', 'color' => '#06b6d4'],
            ['name' => 'Subscriptions', 'type' => 'expense', 'icon' => '📱', 'color' => '#6366f1'],
            ['name' => 'Other', 'type' => 'expense', 'icon' => '📌', 'color' => '#64748b'],
        ];

        foreach ($defaultCategories as $category) {
            Category::create([
                'name' => $category['name'],
                'type' => $category['type'],
                'icon' => $category['icon'],
                'color' => $category['color'],
                'workspace_id' => $workspace->id,
            ]);
        }
    }
}
