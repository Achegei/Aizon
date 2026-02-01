<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function __construct()
    {
        // Ensure only authenticated employers can access these routes
        $this->middleware('auth');
    }

    /**
     * List all jobs of the authenticated employer
     */
    public function index()
    {
        $jobs = Job::where('creator_id', auth()->id())->latest()->get();
        return view('employer.jobs.index', compact('jobs'));
    }

    /**
     * Show form to create a new job
     */
    public function create()
    {
        $user = auth()->user();

        if (!$user->is_approved) {
            return redirect()->route('employer.jobs.index')
                ->with('error', 'Your account is pending approval. You cannot create jobs yet.');
        }

        return view('employer.jobs.create');
    }

    /**
     * Store a new job
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user->is_approved) {
            return redirect()->route('employer.jobs.index')
                ->with('error', 'Your account is pending approval. You cannot create jobs yet.');
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'salary'      => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status'      => 'nullable|in:active,inactive',
        ]);

        Job::create([
            'creator_id'  => $user->id,
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title']),
            'description' => $validated['description'] ?? null,
            'salary'      => $validated['salary'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'status'      => $validated['status'] ?? 'inactive',
        ]);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job created successfully.');
    }

    /**
     * Show form to edit a job
     */
    public function edit(Job $job)
    {
        $this->authorize('update', $job);

        return view('employer.jobs.edit', compact('job'));
    }

    /**
     * Update a job
     */
    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'salary'      => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status'      => 'nullable|in:active,inactive',
        ]);

        $job->update([
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title'], $job->id),
            'description' => $validated['description'] ?? null,
            'salary'      => $validated['salary'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'status'      => $validated['status'] ?? 'inactive',
        ]);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Delete a job
     */
    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);

        $job->delete();

        return back()->with('success', 'Job deleted successfully.');
    }

    /**
     * Generate a unique slug for the job
     */
    protected function generateUniqueSlug(string $title, int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $count = Job::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->count();

        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}
