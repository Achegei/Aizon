<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tool;

class ToolController extends Controller
{
    /**
     * Display a listing of tools.
     */
    public function index()
    {
        $tools = Tool::latest()->get();
        return view('admin.tools.index', compact('tools'));
    }

    /**
     * Show the form for creating a new tool.
     */
    public function create()
    {
        return view('admin.tools.create');
    }

    /**
     * Store a newly created tool.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:active,inactive',
        ]);

        Tool::create($validated + ['creator_id' => auth()->id()]);

        return redirect()->route('tools.index')->with('success', 'Tool created successfully.');
    }

    /**
     * Show the form for editing a tool.
     */
    public function edit(Tool $tool)
    {
        return view('admin.tools.edit', compact('tool'));
    }

    /**
     * Update a tool.
     */
    public function update(Request $request, Tool $tool)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:active,inactive',
        ]);

        $tool->update($validated);

        return redirect()->route('tools.index')->with('success', 'Tool updated successfully.');
    }

    /**
     * Delete a tool.
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();
        return back()->with('success', 'Tool deleted successfully.');
    }
}
