<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Workspace;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Get user's workspace
        $workspace = Workspace::where('user_id', $user->id)->first();

        if (!$workspace) {
            $workspace = Workspace::create([
                'name' => 'Personal Workspace',
                'owner_id' => $user->id,
            ]);
        }

        // Get only categories from user's workspace
        $categories = Category::where('workspace_id', $workspace->id)->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $user = auth()->user();

        // Get or create user's workspace
        $workspace = Workspace::where('user_id', $user->id)->first();

        if (!$workspace) {
            $workspace = Workspace::create([
                'name' => 'Personal Workspace',
                'owner_id' => $user->id,
            ]);
        }

        // Add workspace_id to validated data
        $validated['workspace_id'] = $workspace->id;

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
