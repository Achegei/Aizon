@extends('employer.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Post a New Job</h1>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-6 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success message --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('employer.jobs.store') }}">
        @csrf

        {{-- Job Title --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1" for="title">Job Title <span class="text-red-600">*</span></label>
            <input
                type="text"
                id="title"
                name="title"
                placeholder="e.g., Senior Web Developer"
                value="{{ old('title') }}"
                class="border p-2 w-full rounded"
                required
            >
        </div>

        {{-- Job Description --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1" for="description">Job Description <span class="text-red-600">*</span></label>
            <textarea
                id="description"
                name="description"
                placeholder="Detailed job description..."
                class="border p-2 w-full rounded"
                rows="6"
                required
            >{{ old('description') }}</textarea>
        </div>

        {{-- Location --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1" for="location">Location</label>
            <input
                type="text"
                id="location"
                name="location"
                placeholder="e.g., Nairobi, Kenya"
                value="{{ old('location') }}"
                class="border p-2 w-full rounded"
            >
        </div>

        {{-- Job Type --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1" for="type">Job Type <span class="text-red-600">*</span></label>
            <select
                id="type"
                name="type"
                class="border p-2 w-full rounded"
                required
            >
                <option value="">Select job type</option>
                @foreach(['full-time','part-time','contract','remote'] as $type)
                    <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>
                        {{ ucwords(str_replace('-', ' ', $type)) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Salary --}}
        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1" for="salary_min">Minimum Salary</label>
                <input
                    type="number"
                    step="0.01"
                    id="salary_min"
                    name="salary_min"
                    placeholder="e.g., 50000"
                    value="{{ old('salary_min') }}"
                    class="border p-2 w-full rounded"
                >
            </div>
            <div>
                <label class="block font-semibold mb-1" for="salary_max">Maximum Salary</label>
                <input
                    type="number"
                    step="0.01"
                    id="salary_max"
                    name="salary_max"
                    placeholder="e.g., 100000"
                    value="{{ old('salary_max') }}"
                    class="border p-2 w-full rounded"
                >
            </div>
        </div>

        {{-- Submit Button --}}
        <button
            type="submit"
            class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800"
        >
            Submit Job
        </button>
    </form>
@endsection
