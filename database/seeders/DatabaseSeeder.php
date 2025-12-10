<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create a default workspace for the user
        $workspace = \App\Models\Workspace::create([
            'name' => 'My Personal Finance',
            'description' => 'Personal finance tracker',
            'owner_id' => $user->id,
        ]);

        // Attach user to workspace
        $workspace->members()->attach($user->id, ['role' => 'admin']);

        $this->command->info('Created test user and workspace.');

        // Run seeders in order
        $this->call([
            CategorySeeder::class,
            TransactionSeeder::class,
            BudgetSeeder::class,
            SavingsGoalSeeder::class,
        ]);

        $this->command->info('Database seeding completed successfully!');
    }
}
