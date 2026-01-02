<?php

namespace App\Domain\Services;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Workspace;

class TransactionService
{
    public function createFromVoiceData(array $data, ?Category $category = null): Transaction
    {
        $user = auth()->user();
        $workspace = Workspace::where('owner_id', $user->id)->first();

        if (!$workspace) {
            $workspace = Workspace::create([
                'name' => 'Personal Workspace',
                'owner_id' => $user->id,
            ]);
        }

        // If no category is provided but we have a category name, try to find or create it
        if (!$category && isset($data['category'])) {
            $category = $workspace->categories()
                ->firstOrCreate(
                    ['name' => $data['category']],
                    ['color' => '#6B7280'] // Default gray color
                );
        }

        return Transaction::create([
            'type' => $data['type'] ?? 'expense',
            'amount' => $data['amount'] ?? 0,
            'description' => $data['description'] ?? '',
            'transcript' => $data['transcript'] ?? null,
            'workspace_id' => $workspace->id,
            'category_id' => $category?->id,
            'user_id' => $user->id,
        ]);
    }

    public function getWorkspaceTransactions(Workspace $workspace, array $filters = [])
    {
        $query = $workspace->transactions()
            ->with(['category', 'user'])
            ->latest();

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (isset($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (isset($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        return $query->paginate(15);
    }
}
