@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Course: {{ $course->title }}</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('creator.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" value="{{ old('title', $course->title) }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded" rows="4">{{ old('description', $course->description) }}</textarea>
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Price (USD)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $course->price) }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Category</label>
            <select name="category_id" class="w-full border px-3 py-2 rounded">
                <option value="">-- Select Category --</option>
                @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $course->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded">
                <option value="inactive" @selected(old('status', $course->status) == 'inactive')>Inactive</option>
                <option value="active" @selected(old('status', $course->status) == 'active')>Active</option>
            </select>
        </div>

        <!-- Tags -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tags (comma-separated)</label>
            <input type="text" name="tags" value="{{ old('tags', $course->tags?->pluck('name')->implode(', ') ?? '') }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Thumbnail -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Thumbnail</label>
            @if($course->thumbnail)
                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" class="mb-2 w-48 h-auto border rounded">
            @endif
            <input type="file" name="thumbnail" accept="image/*" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Additional Media -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Additional Media</label>
            @if($course->media && $course->media->count())
                <ul class="mb-2 list-disc pl-5">
                    @foreach($course->media as $media)
                        <li>{{ $media->filename }}</li>
                    @endforeach
                </ul>
            @endif
            <input type="file" name="media[]" multiple class="w-full border px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Course</button>
    </form>
</div>
@endsection
