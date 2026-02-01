<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::where('creator_id', auth()->id())->latest()->get();

        return view('creator.tools.index', compact('tools'));
    }

    public function create()
    {
        return view('creator.tools.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Tool::create([
            'creator_id' => auth()->id(),
            'title'      => $validated['title'],
            'slug'       => Str::slug($validated['title']),
            'description'=> $validated['description'] ?? null,
            'price'      => $validated['price'],
            'category_id'=> $validated['category_id'] ?? null,
        ]);

        return redirect()
            ->route('creator.tools.index')
            ->with('success', 'Tool created successfully.');
    }

    public function edit(Tool $tool)
    {
        $this->authorize('update', $tool);

        return view('creator.tools.edit', compact('tool'));
    }

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
            'slug'        => Str::slug($validated['title']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
        ]);

        return redirect()
            ->route('creator.tools.index')
            ->with('success', 'Tool updated successfully.');
    }

    public function destroy(Tool $tool)
    {
        $this->authorize('delete', $tool);

        $tool->delete();

        return back()->with('success', 'Tool deleted.');
    }
}
