@extends('creator.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10">

    {{-- Page Header --}}
    <div class="mb-10">
        <span class="inline-block mb-2 text-xs font-semibold uppercase tracking-wide text-indigo-600">
            Course Builder
        </span>

        <h1 class="text-3xl font-bold tracking-tight text-zinc-900">
            Create a New Course
        </h1>

        <p class="mt-2 text-sm text-zinc-500">
            Share your knowledge and monetize it beautifully.
        </p>
    </div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('creator.courses.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-8 bg-white rounded-xl border border-zinc-200 p-8 shadow-sm">
        @csrf

        {{-- Title --}}
        <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Course Title
            </label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   placeholder="e.g. Mastering AI for Developers"
                   class="w-full rounded-lg border border-zinc-300 px-4 py-2.5
                          text-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Description
            </label>
            <textarea name="description" rows="4"
                      placeholder="What will students learn?"
                      class="w-full rounded-lg border border-zinc-300 px-4 py-2.5
                             text-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
        </div>

        {{-- Price + Category --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1">
                    Price (USD)
                </label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" required
                       class="w-full rounded-lg border border-zinc-300 px-4 py-2.5
                              text-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1">
                    Category
                </label>
                <select name="category_id"
                        class="w-full rounded-lg border border-zinc-300 px-4 py-2.5
                               text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select a category</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Status
            </label>
            <select name="status"
                    class="w-full rounded-lg border border-zinc-300 px-4 py-2.5
                           text-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="inactive" @selected(old('status') == 'inactive')>
                    Draft (Inactive)
                </option>
                <option value="active" @selected(old('status') == 'active')>
                    Publish (Active)
                </option>
            </select>
        </div>

        {{-- Tags --}}
        <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Tags
            </label>
            <input type="text" name="tags" value="{{ old('tags') }}"
                   placeholder="AI, Laravel, Productivity"
                   class="w-full rounded-lg border border-zinc-300 px-4 py-2.5
                          text-sm focus:border-indigo-500 focus:ring-indigo-500">
            <p class="mt-1 text-xs text-zinc-500">
                Separate tags with commas
            </p>
        </div>

        {{-- Thumbnail --}}
        <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Course Thumbnail
            </label>
            <input type="file" name="thumbnail" accept="image/*"
                   class="block w-full text-sm text-zinc-600
                          file:mr-4 file:rounded-lg file:border-0
                          file:bg-indigo-50 file:px-4 file:py-2
                          file:text-sm file:font-medium file:text-indigo-700
                          hover:file:bg-indigo-100">
        </div>

        {{-- Additional Media --}}
        <div>
            <label class="block text-sm font-medium text-zinc-700 mb-1">
                Additional Media
            </label>
            <input type="file" name="media[]" multiple
                   class="block w-full text-sm text-zinc-600
                          file:mr-4 file:rounded-lg file:border-0
                          file:bg-zinc-100 file:px-4 file:py-2
                          file:text-sm file:font-medium file:text-zinc-700
                          hover:file:bg-zinc-200">
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg
                           bg-gradient-to-r from-indigo-600 to-blue-600
                           px-6 py-2.5 text-sm font-medium text-white
                           shadow-sm hover:opacity-90 transition">
                🚀 Publish Course
            </button>
        </div>
    </form>
</div>
@endsection
