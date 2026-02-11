@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ================= FINANCIAL OVERVIEW ================= --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <div class="bg-white p-6 rounded-lg shadow border">
        <h3 class="text-sm text-gray-500 uppercase">Total Revenue</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">
            ${{ number_format($totalRevenue ?? 0, 2) }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow border">
        <h3 class="text-sm text-gray-500 uppercase">Platform Earnings</h3>
        <p class="text-2xl font-bold mt-2 text-indigo-600">
            ${{ number_format($platformEarnings ?? 0, 2) }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow border">
        <h3 class="text-sm text-gray-500 uppercase">Pending Payouts</h3>
        <p class="text-2xl font-bold mt-2 text-yellow-600">
            ${{ number_format($pendingPayouts ?? 0, 2) }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow border">
        <h3 class="text-sm text-gray-500 uppercase">Total Paid Out</h3>
        <p class="text-2xl font-bold mt-2 text-green-600">
            ${{ number_format($totalPaidOut ?? 0, 2) }}
        </p>
    </div>

</div>

{{-- ================= USERS SECTION ================= --}}
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Users Overview</h2>
    <a href="{{ route('admin.users.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Add New Admin/User
    </a>
</div>

<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-2">{{ $user->id }}</td>
                <td class="px-4 py-2 font-medium">{{ $user->name }}</td>
                <td class="px-4 py-2 text-gray-600 break-all">
                    {{ $user->email }}
                </td>
                <td class="px-4 py-2">
                    {{ ucfirst($user->role->value ?? $user->role) }}
                </td>
                <td class="px-4 py-2">
                    @if($user->is_active)
                        <span class="text-green-600 font-semibold text-xs">Active</span>
                    @else
                        <span class="text-red-600 font-semibold text-xs">Inactive</span>
                    @endif
                </td>

                <td class="px-4 py-2">
                    @if(!$user->isSuperAdmin())
                        <div class="flex flex-wrap gap-2">

                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="bg-yellow-400 text-white text-xs px-2 py-1 rounded hover:bg-yellow-500 whitespace-nowrap">
                                Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600 whitespace-nowrap">
                                    Delete
                                </button>
                            </form>

                        </div>
                    @else
                        <span class="text-gray-400 text-xs">Protected</span>
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
