<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    /**
     * Apply middleware to all routes
     */
    public function __construct()
    {
        $this->middleware(['auth', 'creator', 'approved']);
    }

    /**
     * List all courses of the authenticated creator
     */
    public function index()
    {
        $courses = Course::where('creator_id', auth()->id())
            ->latest()
            ->get();

        return view('creator.courses.index', compact('courses'));
    }

    /**
     * Show form to create a new course
     */
    public function create()
    {
        return view('creator.courses.create');
    }

    /**
     * Store a new course
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status'      => 'required|in:inactive,active',
        ]);

        $course = Course::create([
            'creator_id'  => auth()->id(),
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
            'status'      => $validated['status'],
            'is_active'   => $validated['status'] === 'active' ? 1 : 0,
            'is_approved' => 0, // admin must approve
        ]);

        return redirect()->route('creator.courses.index')
            ->with('success', 'Course created successfully and pending approval.');
    }

    /**
     * Show form to edit a course
     * Using ID instead of slug
     */
    public function edit($id)
    {
        $course = Course::where('id', $id)
                        ->where('creator_id', auth()->id())
                        ->firstOrFail();

        return view('creator.courses.edit', compact('course'));
    }

    /**
     * Update a course
     */
    public function update(Request $request, $id)
    {
        $course = Course::where('id', $id)
                        ->where('creator_id', auth()->id())
                        ->firstOrFail();

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status'      => 'required|in:inactive,active',
        ]);

        $course->update([
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title'], $course->id),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
            'status'      => $validated['status'],
            'is_active'   => $validated['status'] === 'active' ? 1 : 0,
            // Keep is_approved as is — admin handles approval
        ]);

        return redirect()->route('creator.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Delete a course
     */
    public function destroy($id)
    {
        $course = Course::where('id', $id)
                        ->where('creator_id', auth()->id())
                        ->firstOrFail();

        $course->delete();

        return back()->with('success', 'Course deleted successfully.');
    }

    /**
     * Generate a unique slug
     */
    protected function generateUniqueSlug(string $title, int $ignoreId = null): string
    {
        $slug = Str::slug($title);

        $count = Course::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->count();

        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}
