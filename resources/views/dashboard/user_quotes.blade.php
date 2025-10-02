
@extends('layouts.app')
@section('title', 'My Quote Requests | Gemarc Enterprises Inc.')
@section('content')
<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-8 text-center">
        <h1 class="text-3xl font-bold text-purple-800 mb-2 text-center">My Quote Requests</h1>
        <p class="text-gray-700 text-center">View the status and updates of your requested quotes here.</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <table class="min-w-full text-sm text-center">
            <thead>
                <tr class="border-b">
                    <th class="py-2 text-center">Quote #</th>
                    <th class="py-2 text-center">Date</th>
                    <th class="py-2 text-center">Status</th>
                    <th class="py-2 text-center">Total</th>
                    <th class="py-2 text-center">PDF</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotes as $quote)
                <tr class="border-b text-center">
                    <td class="py-2 font-mono text-center">{{ $quote->number ?? ('GEI-GDS-' . date('Y', strtotime($quote->created_at)) . '-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT)) }}</td>
                    <td class="py-2 text-center">{{ $quote->created_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2 text-center">{{ ucfirst($quote->status ?? 'pending') }}</td>
                    <td class="py-2 text-center">₱{{ number_format($quote->total, 2) }}</td>
                    <td class="py-2 text-center">
                        <a href="{{ route('quotes.pdf', $quote->id) }}" target="_blank" class="bg-blue-600 text-black px-3 py-1 rounded hover:bg-blue-700 border-2 border-blue-900 flex items-center gap-1 min-w-[110px] justify-center">
                            <span>📄</span><span>View PDF</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection