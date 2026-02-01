<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    public function __construct()
    {
        // Ensure only authenticated creators can access these routes
        $this->middleware('auth');
    }

    /**
     * List all tools of the authenticated creator
     */
    public function index()
    {
        $tools = Tool::where('creator_id', auth()->id())->latest()->get();

        return view('creator.tools.index', compact('tools'));
    }

    /**
     * Show form to create a new tool
     */
    public function create()
    {
        $user = auth()->user();

        if (!$user->is_approved) {
            return redirect()->route('creator.tools.index')
                ->with('error', 'Your account is pending approval. You cannot create tools yet.');
        }

        return view('creator.tools.create');
    }

    /**
     * Store a new tool
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user->is_approved) {
            return redirect()->route('creator.tools.index')
                ->with('error', 'Your account is pending approval. You cannot create tools yet.');
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Tool::create([
            'creator_id'  => $user->id,
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
        ]);

        return redirect()
            ->route('creator.tools.index')
            ->with('success', 'Tool created successfully.');
    }

    /**
     * Show form to edit a tool
     */
    public function edit(Tool $tool)
    {
        $this->authorize('update', $tool);

        return view('creator.tools.edit', compact('tool'));
    }

    /**
     * Update a tool
     */
    public function update(Request $request, Tool $tool)
    {
        $this->authorize('update', $tool);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $tool->update([
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title'], $tool->id),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
        ]);

        return redirect()
            ->route('creator.tools.index')
            ->with('success', 'Tool updated successfully.');
    }

    /**
     * Delete a tool
     */
    public function destroy(Tool $tool)
    {
        $this->authorize('delete', $tool);

        $tool->delete();

        return back()->with('success', 'Tool deleted.');
    }

    /**
     * Generate a unique slug for the tool
     */
    protected function generateUniqueSlug(string $title, int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $count = Tool::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->count();

        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}
