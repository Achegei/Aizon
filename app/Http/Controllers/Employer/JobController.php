<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        return view('employer.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('employer.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'salary' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:active,inactive',
        ]);

        Job::create($validated + ['creator_id' => auth()->id()]);

        return redirect()->route('employer.jobs.index')->with('success', 'Job created successfully.');
    }

    public function edit(Job $job)
    {
        return view('employer.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'salary' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:active,inactive',
        ]);

        $job->update($validated);

        return redirect()->route('employer.jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return back()->with('success', 'Job deleted successfully.');
    }
}
