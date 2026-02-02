<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends Controller
{
    /**
     * Display a listing of the employer's jobs.
     */
    public function index()
    {
        $jobs = JobListing::where('employer_id', auth()->id())
            ->latest()
            ->get();

        return view('employer.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        if (!auth()->user()->is_approved) {
            return redirect()
                ->route('employer.jobs.index')
                ->with('error', 'Your account is pending approval. You cannot post jobs yet.');
        }

        return view('employer.jobs.create');
    }

    /**
     * Store a newly created job in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->is_approved) {
            return redirect()
                ->route('employer.jobs.index')
                ->with('error', 'Your account is pending approval. You cannot post jobs yet.');
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'nullable|string|max:255',
            'type'        => 'required|in:full-time,part-time,contract,remote',
            'salary_min'  => 'nullable|numeric|min:0',
            'salary_max'  => 'nullable|numeric|min:0',
        ]);

        JobListing::create([
            'employer_id' => auth()->id(),
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title']),
            'description' => $validated['description'],
            'location'    => $validated['location'] ?? null,
            'type'        => $validated['type'],
            'salary_min'  => $validated['salary_min'] ?? null,
            'salary_max'  => $validated['salary_max'] ?? null,
            'is_active'   => 0, // admin approval required
        ]);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job submitted and pending admin approval.');
    }

    /**
     * Show the form for editing the specified job.
     */
    public function edit(JobListing $job)
    {
        $this->authorizeJobOwner($job);

        if (!auth()->user()->is_approved) {
            return redirect()
                ->route('employer.jobs.index')
                ->with('error', 'Your account is pending approval. You cannot edit jobs yet.');
        }

        return view('employer.jobs.edit', compact('job'));
    }

    /**
     * Update the specified job in storage.
     */
    public function update(Request $request, JobListing $job)
    {
        $this->authorizeJobOwner($job);

        if (!auth()->user()->is_approved) {
            return redirect()
                ->route('employer.jobs.index')
                ->with('error', 'Your account is pending approval. You cannot update jobs yet.');
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'nullable|string|max:255',
            'type'        => 'required|in:full-time,part-time,contract,remote',
            'salary_min'  => 'nullable|numeric|min:0',
            'salary_max'  => 'nullable|numeric|min:0',
        ]);

        $job->update([
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title'], $job->id),
            'description' => $validated['description'],
            'location'    => $validated['location'] ?? null,
            'type'        => $validated['type'],
            'salary_min'  => $validated['salary_min'] ?? null,
            'salary_max'  => $validated['salary_max'] ?? null,
            'is_active'   => 0, // re-approval required
        ]);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job updated and sent for re-approval.');
    }

    /**
     * Remove the specified job from storage.
     */
    public function destroy(JobListing $job)
    {
        $this->authorizeJobOwner($job);

        $job->delete();

        return back()->with('success', 'Job deleted successfully.');
    }

    /**
     * Generate a unique slug for the job title.
     */
    protected function generateUniqueSlug(string $title, int $ignoreId = null): string
    {
        $slug = Str::slug($title);

        $count = JobListing::where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->count();

        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }

    /**
     * Check if the authenticated user owns this job.
     */
    protected function authorizeJobOwner(JobListing $job)
    {
        if ($job->employer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
