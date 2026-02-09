{{-- resources/views/admin/layouts/roles-permissions.blade.php --}}
@extends('layouts.admin')

@section('title', $title ?? 'Roles & Permissions')
@section('page-title', $title ?? 'Roles & Permissions')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

    {{-- Alerts --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded shadow">
            {{ session('error') }}
        </div>
    @endif

    {{-- Page Content --}}
    <div class="bg-white shadow rounded-lg p-6">
        @yield('roles-permissions-content')
</div>
@endsection
