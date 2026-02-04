@extends('creator.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Tools</h1>
        <a href="{{ route('creator.tools.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Create New Tool</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($tools->isEmpty())
        <p class="text-gray-600">You haven’t created any tools yet.</p>
    @else
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="w-full table-auto border border-gray-200">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="px-4 py-2 border">Title</th>
                        <th class="px-4 py-2 border">Category</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($tools as $tool)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $tool->title }}</td>
                            <td class="px-4 py-2">{{ $tool->category?->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $tool->formattedPrice() }}</td>
                            <td class="px-4 py-2">
                                @if($tool->isActive())
                                    <span class="text-green-600 font-semibold">Active</span>
                                @else
                                    <span class="text-red-600 font-semibold">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('creator.tools.edit', $tool->id) }}" 
                                   class="bg-yellow-400 px-3 py-1 rounded text-white">Edit</a>

                                <form action="{{ route('creator.tools.destroy', $tool->id) }}" 
                                      method="POST" class="inline-block" 
                                      onsubmit="return confirm('Delete this tool?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 px-3 py-1 rounded text-white">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
