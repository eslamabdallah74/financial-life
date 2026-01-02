<?php

namespace App\Http\Controllers;

use App\Application\Services\VoiceTransactionService;
use App\Domain\Services\TransactionService;
use App\Domain\Services\VoiceProcessingService;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Workspace;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private VoiceTransactionService $voiceTransactionService,
        private TransactionService $transactionService,
        private VoiceProcessingService $voiceProcessingService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = \App\Models\Transaction::with('category')
            ->where('user_id', auth()->id())
            ->orderBy('transaction_date', 'desc')
            ->paginate(15);

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $workspace = Workspace::where('user_id', $user->id)->first();

        if (!$workspace) {
            $workspace = Workspace::create([
                'name' => 'Personal Workspace',
                'owner_id' => $user->id,
            ]);
        }

        $categories = Category::where('workspace_id', $workspace->id)->get();
        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $validated['user_id'] = auth()->id();

        // Get or create a default workspace for the user
        $workspace = auth()->user()->ownedWorkspaces()->first();
        if (!$workspace) {
            $workspace = Workspace::create([
                'name' => 'Personal Workspace',
                'owner_id' => auth()->id(),
            ]);
            // Add user to workspace
            auth()->user()->workspaces()->attach($workspace->id, ['role' => 'owner']);
        }

        $validated['workspace_id'] = $workspace->id;

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $user = auth()->user();
        $workspace = Workspace::where('user_id', $user->id)->first();

        if (!$workspace) {
            $workspace = Workspace::create([
                'name' => 'Personal Workspace',
                'owner_id' => $user->id,
            ]);
        }

        $categories = Category::where('workspace_id', $workspace->id)->get();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }

    public function processVoice(Request $request)
    {
        try {
            $data = $request->validate([
                "audio" => 'required|file|mimes:webm,wav,mp3,ogg,mpeg|max:10240', // Max 10MB
            ]);

            $audioFile = $data['audio'];

            // Process voice input to get extracted data (don't create transaction yet)
            $extractedData = $this->voiceProcessingService->processVoiceInput($audioFile);

            // Check if processing failed
            if (isset($extractedData['error'])) {
                return response()->json([
                    'success' => false,
                    'message' => $extractedData['message'] ?? 'Failed to process voice recording',
                    'details' => $extractedData['details'] ?? null,
                ], 422);
            }

            // Get categories for frontend mapping
            $user = auth()->user();
            $workspace = $user ? Workspace::where('user_id', $user->id)->first() : null;
            $categories = $workspace ? Category::where('workspace_id', $workspace->id)->get() : collect();

            // Find matching category ID
            $categoryId = null;
            $categoryName = $extractedData['category_name'] ?? null;

            if ($categoryName) {
                $matchedCategory = $categories->first(function ($cat) use ($categoryName) {
                    return strcasecmp($cat->name, $categoryName) === 0;
                });

                if ($matchedCategory) {
                    $categoryId = $matchedCategory->id;
                }
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'type' => $extractedData['type'] ?? 'expense',
                    'amount' => $extractedData['amount'] ?? 0,
                    'description' => $extractedData['description'] ?? '',
                    'category_id' => $categoryId,
                    'category_name' => $categoryName,
                    'transaction_date' => $extractedData['transaction_date'] ?? now()->format('Y-m-d'),
                    'ai_confidence_score' => $extractedData['ai_confidence_score'] ?? 70,
                    'transcript' => $extractedData['transcript'] ?? '',
                ],
                'categories' => $categories->map(fn($cat) => [
                    'id' => $cat->id,
                    'name' => $cat->name,
                ]),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid audio file',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Voice processing controller error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your voice recording',
                'details' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
