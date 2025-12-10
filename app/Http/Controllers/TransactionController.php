<?php

namespace App\Http\Controllers;

use App\Application\Services\VoiceTransactionService;
use App\Domain\Services\TransactionService;
use App\Models\Workspace;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private VoiceTransactionService $voiceTransactionService,
        private TransactionService $transactionService
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
        $categories = \App\Models\Category::all();
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

        \App\Models\Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Transaction $transaction)
    {
        $categories = \App\Models\Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Transaction $transaction)
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
    public function destroy(\App\Models\Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }

    public function processVoice(Request $request)
    {
        $data = $request->validate([
            "audio" => 'required|file',
        ]);

        $audioFile = $data['audio'];

        $result = $this->voiceTransactionService->processVoiceTransaction(
            $audioFile,
        );

        return response()->json($result);
    }
}
