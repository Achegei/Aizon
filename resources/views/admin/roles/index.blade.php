{{-- resources/views/admin/roles/index.blade.php --}}
@extends('admin.layouts.roles-permissions')

@section('roles-permissions-content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Roles Management</h1>
    <a href="{{ route('admin.roles.create') }}" 
       class="px-5 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition shadow">
        + New Role
    </a>
</div>

{{-- Alerts --}}
@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded shadow">
        {{ session('error') }}
    </div>
@endif

<div class="overflow-x-auto bg-white rounded shadow border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($roles as $role)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-700">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">{{ ucfirst($role->name) }}</td>
                    <td class="px-6 py-4 whitespace-normal">
                        @forelse($role->permissions as $permission)
                            <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-indigo-500 rounded-full mr-1 mb-1">
                                {{ ucfirst($permission->name) }}
                            </span>
                        @empty
                            <span class="text-gray-400 italic text-sm">No permissions</span>
                        @endforelse
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                        <a href="{{ route('admin.roles.show', $role->id) }}" 
                           class="text-gray-700 hover:text-gray-900 transition">View</a>
                        @can('manage_admins')
                        <a href="{{ route('admin.roles.edit', $role->id) }}" 
                           class="text-blue-600 hover:text-blue-900 transition">Edit</a>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 transition">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-500 italic">No roles found. Create your first role above!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
