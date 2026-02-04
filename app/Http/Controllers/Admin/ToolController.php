<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tool;

class ToolController extends Controller
{
    /**
     * Display a listing of all tools for admin approval.
     */
    public function index()
    {
        // Include creator info for admin overview
        $tools = Tool::with('creator')->latest()->get();
        return view('admin.tools.index', compact('tools'));
    }

    /**
     * Show the form for editing a tool (optional for admin).
     */
    public function edit(Tool $tool)
    {
        return view('admin.tools.edit', compact('tool'));
    }

    /**
     * Display a specific tool.
     */
    public function show(Tool $tool)
    {
        // Load creator relationship if needed
        $tool->load('creator');

        return view('admin.tools.show', compact('tool'));
    }


    /**
     * Approve a tool (set as active).
     */
    public function approve(Tool $tool)
    {
        $tool->update(['is_active' => true]);
        return back()->with('success', 'Tool approved successfully.');
    }

    /**
     * Disapprove a tool (set as inactive).
     */
    public function disapprove(Tool $tool)
    {
        $tool->update(['is_active' => false]);
        return back()->with('success', 'Tool disapproved successfully.');
    }

    /**
     * Delete a tool permanently.
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();
        return back()->with('success', 'Tool deleted successfully.');
    }
}
