<div x-data="{ open: false }" class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 ease-in-out border border-gray-200 flex flex-col justify-between p-6">

    {{-- Job Info --}}
    <div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h3>
        <p class="text-gray-500 mt-1 text-sm">{{ $job->employer->name ?? 'Unknown Employer' }}</p>
        <p class="text-gray-400 mt-1 text-sm">{{ $job->location ?? 'Remote' }} • {{ ucfirst($job->type ?? 'Full-time') }}</p>

        @if($job->salary_min && $job->salary_max)
        <p class="text-gray-600 mt-2 text-sm font-semibold">💰 ${{ $job->salary_min }} - ${{ $job->salary_max }}</p>
        @endif

        <p class="text-gray-400 mt-2 text-xs">🕒 Posted {{ $job->created_at->diffForHumans() }}</p>
    </div>

    {{-- Buttons --}}
    <div class="mt-4 flex justify-between gap-2">
        <a href="{{ route('public.jobs.show', $job->id) }}"
           class="px-5 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 font-semibold transition duration-200">
           View Job
        </a>
        <button @click="open = true"
                class="px-5 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-lg hover:from-purple-600 hover:to-indigo-600 font-semibold transition duration-200 shadow-md hover:shadow-lg">
            Apply Now
        </button>
    </div>

    {{-- Side Modal --}}
    <div x-show="open" x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex pointer-events-none">

        {{-- Page behind remains visible --}}
        <div class="w-full pointer-events-auto flex justify-end">
            <div @click.away="open = false"
                 x-transition:enter="transition transform ease-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition transform ease-in duration-200"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="w-full max-w-md h-full bg-white shadow-2xl p-6 overflow-y-auto pointer-events-auto">

                {{-- Close Button --}}
                <button @click="open = false" class="mb-4 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>

                {{-- Modal Content --}}
                <h2 class="text-3xl font-bold mb-4 text-gray-900">Apply for {{ $job->title }}</h2>
                <p class="text-gray-600 mb-6 whitespace-pre-line">{{ $job->description }}</p>

                <form method="POST" action="{{ route('jobs.apply', $job->id) }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required
                               class="w-full px-4 py-2 border border-purple-300 rounded-xl focus:ring focus:ring-purple-300 focus:border-purple-400 transition text-gray-900 bg-white">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required
                               class="w-full px-4 py-2 border border-purple-300 rounded-xl focus:ring focus:ring-purple-300 focus:border-purple-400 transition text-gray-900 bg-white">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Cover Letter</label>
                        <textarea name="cover_letter" rows="4" required
                                  class="w-full px-4 py-2 border border-purple-300 rounded-xl focus:ring focus:ring-purple-300 focus:border-purple-400 transition text-gray-900 bg-white"></textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Attach CV</label>
                        <input type="file" name="cv" accept=".pdf,.doc,.docx"
                               class="w-full px-3 py-2 border border-purple-300 rounded-xl text-gray-900 bg-white">
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" @click="open = false"
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 font-semibold transition">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-xl hover:from-purple-600 hover:to-indigo-600 font-semibold shadow-md transition">
                            Submit Application
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
