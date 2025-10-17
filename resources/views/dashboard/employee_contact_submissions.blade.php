@extends('layouts.ecommerce')
@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="flex flex-col items-center mb-6">
        <img src="/images/gemarclogo.png" alt="Gemarc Logo" class="h-16 mb-2 print-logo" style="max-height:60px;">
        <h1 class="text-2xl font-bold text-green-800 mb-2">Website Submissions</h1>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex justify-end gap-3 mb-4 no-print">
            <form method="POST" action="{{ route('employee.contact_submissions.clear') }}" onsubmit="return confirm('Are you sure you want to clear all submissions?');">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded font-semibold shadow hover:bg-red-700 transition">Clear All</button>
            </form>
            <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded font-semibold shadow hover:bg-blue-700 transition">Print / Save PDF</button>
        </div>
        <div id="submissions-table">
            <table class="min-w-full text-sm border border-gray-300 print-table" style="border-collapse:collapse;width:100%;">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="py-2 px-3 border-b border-gray-300">Name</th>
                        <th class="py-2 px-3 border-b border-gray-300">Email</th>
                        <th class="py-2 px-3 border-b border-gray-300">Phone</th>
                        <th class="py-2 px-3 border-b border-gray-300">Company</th>
                        <th class="py-2 px-3 border-b border-gray-300">Service</th>
                        <th class="py-2 px-3 border-b border-gray-300">Message</th>
                        <th class="py-2 px-3 border-b border-gray-300">Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                    <tr class="border-b">
                        <td class="py-2 px-3 border-b border-gray-200">{{ $submission->full_name }}</td>
                        <td class="py-2 px-3 border-b border-gray-200">{{ $submission->email }}</td>
                        <td class="py-2 px-3 border-b border-gray-200">{{ $submission->phone }}</td>
                        <td class="py-2 px-3 border-b border-gray-200">{{ $submission->company }}</td>
                        <td class="py-2 px-3 border-b border-gray-200">{{ $submission->service_interest }}</td>
                        <td class="py-2 px-3 border-b border-gray-200">{{ $submission->message }}</td>
                        <td class="py-2 px-3 border-b border-gray-200">{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
@media print {
    .no-print, .ecommerce-navbar, .footer, .site-footer, .site-footer__bar, header, nav, aside { display: none !important; }
    .print-logo { display: block !important; margin-bottom: 10px; }
    .print-table th, .print-table td { border: 1px solid #888 !important; }
    body { background: #fff !important; }
}
</style>
    </div>
</div>
@endsection
