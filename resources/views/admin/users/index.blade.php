{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-gray-900">Users</h1>
        <p class="mt-1 text-sm text-gray-600">
            Manage platform users, approvals, roles, and account status.
        </p>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    {{-- Table Card --}}
    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">


        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                    <th class="px-6 py-4 w-12">#</th>
                    <th class="px-6 py-4">User</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Approval</th>
                    <th class="px-6 py-4">Account</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                    @php
                        $role = strtolower(
                            $user->role instanceof \App\Enums\UserRole
                                ? $user->role->value
                                : $user->role
                        );
                    @endphp

                    <tr class="hover:bg-gray-50 transition">

                        {{-- Numbering --}}
                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">
                            {{ $users->firstItem() + $loop->index }}
                        </td>

                        {{-- User --}}
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-900">{{ $user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $user->email }}</span>
                            </div>
                        </td>

                        {{-- Role --}}
                        <td class="px-6 py-4 capitalize text-gray-700">
                            {{ $role }}
                        </td>

                        {{-- Approval --}}
                        <td class="px-6 py-4">
                            @if(in_array($role, ['employer', 'creator']))
                                <div class="flex items-center gap-2">
                                    @if($user->is_approved)
                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                            Approved
                                        </span>

                                        <form action="{{ route('admin.users.disapprove', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="text-xs font-semibold text-red-600 hover:text-red-700">
                                                Disapprove
                                            </button>
                                        </form>
                                    @else
                                        <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">
                                            Pending
                                        </span>

                                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="text-xs font-semibold text-green-600 hover:text-green-700">
                                                Approve
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <span class="text-sm text-gray-400">—</span>
                            @endif
                        </td>

                        {{-- Account --}}
                        <td class="px-6 py-4">
                            @if($user->is_active)
                                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex gap-3">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                                    Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-semibold text-gray-500 hover:text-red-600">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="flex items-center justify-between border-t bg-gray-50 px-6 py-4">
                <div class="text-sm text-gray-600">
                    Showing
                    <span class="font-semibold">{{ $users->firstItem() }}</span>
                    to
                    <span class="font-semibold">{{ $users->lastItem() }}</span>
                    of
                    <span class="font-semibold">{{ $users->total() }}</span>
                    users
                </div>

                <div>
                    {{ $users->links() }}
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
