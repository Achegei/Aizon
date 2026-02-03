@extends('employer.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10 bg-white rounded-2xl shadow-md">
    
    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-zinc-900">Post a New Job</h1>
        <p class="mt-2 text-sm text-zinc-500">
            Fill out the details below to create a new job posting.
        </p>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 mb-6 rounded-lg">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success Message --}}
    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 mb-6 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('employer.jobs.store') }}" class="space-y-6">
        @csrf

        {{-- Job Title --}}
        <div>
            <label for="title" class="block font-semibold mb-1 text-zinc-700">Job Title <span class="text-red-600">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                placeholder="e.g., Senior Web Developer"
                class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                required
            >
        </div>

        {{-- Job Description --}}
        <div>
            <label for="description" class="block font-semibold mb-1 text-zinc-700">Job Description <span class="text-red-600">*</span></label>
            <textarea id="description" name="description" rows="6" placeholder="Detailed job description..."
                class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                required
            >{{ old('description') }}</textarea>
        </div>

        {{-- Location --}}
        <div>
            <label for="location" class="block font-semibold mb-1 text-zinc-700">Location</label>
            <input type="text" id="location" name="location" value="{{ old('location') }}"
                placeholder="e.g., Nairobi, Kenya"
                class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
            >
        </div>

        {{-- Job Type --}}
        <div>
            <label for="type" class="block font-semibold mb-1 text-zinc-700">Job Type <span class="text-red-600">*</span></label>
            <select id="type" name="type" required
                class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                <option value="">Select job type</option>
                @foreach(['full-time','part-time','contract','remote'] as $type)
                    <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>
                        {{ ucwords(str_replace('-', ' ', $type)) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Salary --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="salary_min" class="block font-semibold mb-1 text-zinc-700">Minimum Salary</label>
                <input type="number" step="0.01" id="salary_min" name="salary_min" value="{{ old('salary_min') }}"
                    placeholder="e.g., 50000"
                    class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                >
            </div>
            <div>
                <label for="salary_max" class="block font-semibold mb-1 text-zinc-700">Maximum Salary</label>
                <input type="number" step="0.01" id="salary_max" name="salary_max" value="{{ old('salary_max') }}"
                    placeholder="e.g., 100000"
                    class="w-full border border-zinc-200 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                >
            </div>
        </div>

        {{-- Submit Button --}}
        <div>
            <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 rounded-xl shadow-lg hover:opacity-90 transition">
                ➕ Submit Job
            </button>
        </div>
    </form>
</div>
@endsection
