@extends('layouts.ecommerce')
@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Contact Form Submissions</h1>
    <div class="bg-white rounded-xl shadow p-6">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-3">Name</th>
                    <th class="py-2 px-3">Email</th>
                    <th class="py-2 px-3">Phone</th>
                    <th class="py-2 px-3">Company</th>
                    <th class="py-2 px-3">Service</th>
                    <th class="py-2 px-3">Message</th>
                    <th class="py-2 px-3">Submitted At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                <tr class="border-b">
                    <td class="py-2 px-3">{{ $submission->full_name }}</td>
                    <td class="py-2 px-3">{{ $submission->email }}</td>
                    <td class="py-2 px-3">{{ $submission->phone }}</td>
                    <td class="py-2 px-3">{{ $submission->company }}</td>
                    <td class="py-2 px-3">{{ $submission->service_interest }}</td>
                    <td class="py-2 px-3">{{ $submission->message }}</td>
                    <td class="py-2 px-3">{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
