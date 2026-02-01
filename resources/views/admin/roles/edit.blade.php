{{-- resources/views/admin/roles/edit.blade.php --}}
@extends('admin.layouts.roles-permissions')

@section('roles-permissions-content')
<div class="max-w-3xl mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Role: {{ ucfirst($role->name) }}</h1>

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Role Name</label>
            <input type="text" name="name" id="name" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ old('name', $role->name) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Assign Permissions</label>
            <div class="grid grid-cols-3 gap-2">
                @foreach($permissions as $permission)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                               class="form-checkbox h-4 w-4 text-blue-600"
                               {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Update Role
        </button>
        <a href="{{ route('admin.roles.index') }}" 
           class="ml-4 px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
            Cancel
        </a>
    </form>
</div>
@endsection
