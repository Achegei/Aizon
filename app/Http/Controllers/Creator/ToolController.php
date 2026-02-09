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
        // Only authenticated creators can access these routes
        $this->middleware(['auth', 'creator', 'approved']);
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
        $this->authorize('create', Tool::class);

        return view('creator.tools.create');
    }

    /**
     * Store a new tool
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tool::class);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Tool::create([
            'creator_id'  => auth()->id(),
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
            'status'      => 'inactive', // default to inactive
            'is_active'   => false,      // default admin approval
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
            'status'      => 'required|in:active,inactive',
            'tags'        => 'nullable|string',
            'thumbnail'   => 'nullable|image|max:2048',
            'media.*'     => 'nullable|image|max:2048',
        ]);

        // 1️⃣ Update main tool attributes including status
        $tool->update([
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title'], $tool->id),
            'description' => $validated['description'] ?? $tool->description,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
            'status'      => $validated['status'],
        ]);

        // 2️⃣ Handle tags (comma-separated)
        if (!empty($validated['tags'])) {
            $tags = collect(explode(',', $validated['tags']))
                ->map(fn($t) => trim($t))
                ->filter();
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = \App\Models\Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $tool->tags()->sync($tagIds);
        } else {
            $tool->tags()->detach();
        }

        // 3️⃣ Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('tools/thumbnails', 'public');
            $tool->update(['thumbnail' => $path]);
        }

        // 4️⃣ Handle additional media uploads
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $mediaFile) {
                $path = $mediaFile->store('tools/media', 'public');
                $tool->media()->create(['path' => $path]);
            }
        }

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
