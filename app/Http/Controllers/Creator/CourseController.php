<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function __construct()
    {
        // Ensure only authenticated creators can access these routes
        $this->middleware('auth');
    }

    /**
     * List all courses of the authenticated creator
     */
    public function index()
    {
        $courses = Course::where('creator_id', auth()->id())->latest()->get();

        return view('creator.courses.index', compact('courses'));
    }

    /**
     * Show form to create a new course
     */
    public function create()
    {
        $user = auth()->user();

        if (!$user->is_approved) {
            return redirect()->route('creator.courses.index')
                ->with('error', 'Your account is pending approval. You cannot create courses yet.');
        }

        return view('creator.courses.create');
    }

    /**
     * Store a new course
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user->is_approved) {
            return redirect()->route('creator.courses.index')
                ->with('error', 'Your account is pending approval. You cannot create courses yet.');
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Course::create([
            'creator_id'  => $user->id,
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
        ]);

        return redirect()
            ->route('creator.courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Show form to edit a course
     */
    public function edit(Course $course)
    {
        $this->authorize('update', $course);

        return view('creator.courses.edit', compact('course'));
    }

    /**
     * Update a course
     */
    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $course->update([
            'title'       => $validated['title'],
            'slug'        => $this->generateUniqueSlug($validated['title'], $course->id),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
        ]);

        return redirect()
            ->route('creator.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Delete a course
     */
    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        $course->delete();

        return back()->with('success', 'Course deleted.');
    }

    /**
     * Generate a unique slug for the course
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
