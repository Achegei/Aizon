@extends('layouts.admin')

@section('content')
<section class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-gray-900">Payouts</h1>

        @if($payouts->isEmpty())
            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center text-gray-500 shadow-sm">
                No payouts found.
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($payouts as $payout)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-900 font-medium">{{ $payout->user->name ?? 'Unknown' }}</td>
                                <td class="px-6 py-4 font-mono text-gray-900">${{ number_format($payout->amount, 2) }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $payout->method ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-gray-700 capitalize">{{ $payout->status }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $payout->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</section>
@endsection
