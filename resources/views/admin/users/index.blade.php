{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.dashboard') {{-- assuming you have an admin layout --}}

@section('title', 'Manage Users')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Users</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3 border-b">ID</th>
                    <th class="p-3 border-b">Name</th>
                    <th class="p-3 border-b">Email</th>
                    <th class="p-3 border-b">Role</th>
                    <th class="p-3 border-b">Approval</th>
                    <th class="p-3 border-b">Account</th>
                    <th class="p-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @php
                        // Ensure we have string role for display
                        $role = strtolower($user->role instanceof \App\Enums\UserRole ? $user->role->value : $user->role);
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border-b">{{ $user->id }}</td>
                        <td class="p-3 border-b">{{ $user->name }}</td>
                        <td class="p-3 border-b">{{ $user->email }}</td>
                        <td class="p-3 border-b capitalize">{{ $role }}</td>

                        {{-- Approval Column --}}
                        <td class="p-3 border-b">
                            @if(in_array($role, ['employer', 'creator']))
                                @if($user->is_approved)
                                    <span class="text-green-600 font-semibold">Approved</span>

                                    {{-- Disapprove Button --}}
                                    <form action="{{ route('admin.users.disapprove', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="ml-2 bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Disapprove
                                        </button>
                                    </form>
                                @else
                                    <span class="text-yellow-600 font-semibold">Pending</span>

                                    {{-- Approve Button --}}
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="ml-2 bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                            Approve
                                        </button>
                                    </form>
                                @endif
                            @else
                                <span class="text-gray-600">—</span>
                            @endif
                        </td>

                        {{-- Account Status --}}
                        <td class="p-3 border-b">
                            @if($user->is_active)
                                <span class="text-green-600 font-semibold">Active</span>
                            @else
                                <span class="text-red-600 font-semibold">Inactive</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="p-3 border-b">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-800 ml-1">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
