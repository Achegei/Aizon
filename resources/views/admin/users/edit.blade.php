{{-- resources/views/admin/users/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit User: ' . $user->name)
@section('page-title', 'Edit User: ' . $user->name)

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-6">Edit User: {{ $user->name }}</h2>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div>
            <label class="block font-medium text-gray-700">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        {{-- Email --}}
        <div>
            <label class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        {{-- Password --}}
        <div>
            <label class="block font-medium text-gray-700">
                Password <span class="text-sm text-gray-400">(leave blank to keep current)</span>
            </label>
            <input type="password" name="password"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Role --}}
        <div>
            <label class="block font-medium text-gray-700">Role</label>
            <select name="role"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                required>
                <option value="super_admin" {{ old('role', $user->role->value) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="admin" {{ old('role', $user->role->value) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('role', $user->role->value) == 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="buyer" {{ old('role', $user->role->value) == 'buyer' ? 'selected' : '' }}>Buyer</option>
                <option value="creator" {{ old('role', $user->role->value) == 'creator' ? 'selected' : '' }}>Creator</option>
                <option value="employer" {{ old('role', $user->role->value) == 'employer' ? 'selected' : '' }}>Employer</option>
            </select>
        </div>

        {{-- Active Toggle --}}
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="is_active" value="1" id="is_active"
                class="h-4 w-4 text-blue-600 border-gray-300 rounded"
                {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="text-gray-700 font-medium">Active</label>
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Update User
            </button>
            <a href="{{ route('admin.users.index') }}"
                class="ml-4 px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
