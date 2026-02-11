@extends('layouts.admin')

@section('content')
<section class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-gray-900">Orders</h1>

        @if($orders->isEmpty())
            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center text-gray-500 shadow-sm">
                No orders found.
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buyer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creator</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tool/Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Platform Fee</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $order->buyer->name ?? 'Unknown' }}
                                </td>

                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $order->creator->name ?? 'Unknown' }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    @if($order->tool)
                                        {{ $order->tool->title }}
                                    @elseif($order->course)
                                        {{ $order->course->title }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td class="px-6 py-4 font-mono text-gray-900">
                                    ${{ number_format($order->amount, 2) }}
                                </td>

                                <td class="px-6 py-4 font-mono text-gray-900">
                                    ${{ number_format($order->platform_fee, 2) }}
                                </td>

                                <td class="px-6 py-4 capitalize">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if($order->status === 'completed') bg-green-100 text-green-700
                                        @elseif($order->status === 'paid') bg-blue-100 text-blue-700
                                        @elseif($order->status === 'pending') bg-yellow-100 text-yellow-700
                                        @else bg-gray-100 text-gray-700
                                        @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @if($order->status === 'completed')

                                        @if(!$order->payout)
                                            <form action="{{ route('admin.payouts.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <input type="hidden" name="method" value="manual">

                                                <button type="submit"
                                                    class="px-3 py-1 text-xs bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                                                    Create Payout
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-green-600 text-sm font-semibold">
                                                Payout Created
                                            </span>
                                        @endif

                                    @else
                                        <span class="text-gray-400 text-sm">
                                            Not Eligible
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-gray-500 text-sm">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</section>
@endsection
