{{-- resources/views/admin/roles/show.blade.php --}}
@extends('admin.layouts.roles-permissions')

@section('roles-permissions-content')
<div class="max-w-3xl mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Role Details: {{ ucfirst($role->name) }}</h1>

    <div class="mb-4">
        <h2 class="text-gray-700 font-medium mb-2">Role Name</h2>
        <p class="text-gray-900">{{ ucfirst($role->name) }}</p>
    </div>

    <div class="mb-4">
        <h2 class="text-gray-700 font-medium mb-2">Permissions</h2>
        <div class="flex flex-wrap gap-2">
            @foreach($role->permissions as $permission)
                <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-indigo-500 rounded-full">
                    {{ $permission->name }}
                </span>
            @endforeach
        </div>
    </div>

    <a href="{{ route('admin.roles.index') }}" 
       class="mt-4 inline-block px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
        Back to Roles
    </a>
</div>
@endsection
