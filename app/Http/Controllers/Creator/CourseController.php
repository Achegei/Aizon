<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('creator_id', auth()->id())->latest()->get();
        return view('creator.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('creator.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Course::create([
            'creator_id'  => auth()->id(),
            'title'       => $validated['title'],
            'slug'        => Str::slug($validated['title']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
        ]);

        return redirect()
            ->route('creator.courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        return view('creator.courses.edit', compact('course'));
    }

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
            'slug'        => Str::slug($validated['title']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
        ]);

        return redirect()
            ->route('creator.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        $course->delete();

        return back()->with('success', 'Course deleted.');
    }
}
