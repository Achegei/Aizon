@extends('employer.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10 bg-white rounded-2xl shadow-md">

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-zinc-900">Edit Job</h1>
        <p class="mt-2 text-sm text-zinc-500">
            Update the details of your job posting.
        </p>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 mb-6 rounded-lg">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Update Form --}}
    <form method="POST" action="{{ route('employer.jobs.update', $job->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Job Title --}}
        <div>
            <label class="block font-semibold mb-1 text-zinc-700">
                Job Title <span class="text-red-600">*</span>
            </label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $job->title) }}"
                   class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                   required>
        </div>

        {{-- Job Description --}}
        <div>
            <label class="block font-semibold mb-1 text-zinc-700">
                Job Description <span class="text-red-600">*</span>
            </label>
            <textarea name="description"
                      rows="6"
                      class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                      required>{{ old('description', $job->description) }}</textarea>
        </div>

        {{-- Location --}}
        <div>
            <label class="block font-semibold mb-1 text-zinc-700">Location</label>
            <input type="text"
                   name="location"
                   value="{{ old('location', $job->location) }}"
                   class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        </div>

        {{-- Job Type --}}
        <div>
            <label class="block font-semibold mb-1 text-zinc-700">
                Job Type <span class="text-red-600">*</span>
            </label>
            <select name="type"
                    class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                    required>
                @foreach (['full-time','part-time','contract','remote'] as $type)
                    <option value="{{ $type }}"
                        {{ old('type', $job->type) === $type ? 'selected' : '' }}>
                        {{ ucwords(str_replace('-', ' ', $type)) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Salary --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1 text-zinc-700">Minimum Salary</label>
                <input type="number"
                       step="0.01"
                       name="salary_min"
                       value="{{ old('salary_min', $job->salary_min) }}"
                       class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <div>
                <label class="block font-semibold mb-1 text-zinc-700">Maximum Salary</label>
                <input type="number"
                       step="0.01"
                       name="salary_max"
                       value="{{ old('salary_max', $job->salary_max) }}"
                       class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex justify-between items-center gap-4">
            <a href="{{ route('employer.jobs.index') }}"
               class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition">
                Cancel
            </a>

            <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:opacity-90 transition">
                💾 Update Job
            </button>
        </div>

    </form>
</div>
@endsection
