@extends('layouts.app')
@section('title', 'Quote Management | Gemarc Enterprises Inc.')
@section('content')
<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-8 text-center">
        <h1 class="text-3xl font-bold text-purple-800 mb-2">Quote Management</h1>
        <p class="text-gray-700">View and manage all customer quote requests here.</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left border-b">
                    <th class="py-2">Quote #</th>
                    <th class="py-2">Customer</th>
                    <th class="py-2">Date</th>
                    <th class="py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotes as $quote)
                <tr class="border-b">
                    <td class="py-2 font-mono">{{ $quote->id }}</td>
                    <td class="py-2">{{ $quote->user->name ?? 'N/A' }}</td>
                    <td class="py-2">{{ $quote->created_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2">{{ ucfirst($quote->status ?? 'pending') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
