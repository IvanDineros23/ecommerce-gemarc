
@extends('layouts.app')
@section('title', 'My Quote Requests | Gemarc Enterprises Inc.')
@section('content')
<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-8 text-center">
        <h1 class="text-3xl font-bold text-purple-800 mb-2">My Quote Requests</h1>
        <p class="text-gray-700">View the status and updates of your requested quotes here.</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left border-b">
                    <th class="py-2">Quote #</th>
                    <th class="py-2">Date</th>
                    <th class="py-2">Status</th>
                    <th class="py-2">Total</th>
                    <th class="py-2">Response</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotes as $quote)
                <tr class="border-b">
                    <td class="py-2 font-mono">{{ $quote->id }}</td>
                    <td class="py-2">{{ $quote->created_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2">{{ ucfirst($quote->status ?? 'pending') }}</td>
                    <td class="py-2">₱{{ number_format($quote->total, 2) }}</td>
                    <td class="py-2">
                        @if($quote->response_file)
                            <a href="{{ asset('storage/' . $quote->response_file) }}" target="_blank" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Download Quotation</a>
                        @else
                            <span class="text-gray-500">No response yet</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection