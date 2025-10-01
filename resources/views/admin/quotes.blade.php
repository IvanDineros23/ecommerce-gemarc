@extends('layouts.admin')
@section('title', 'All Quotes | Admin Panel')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-6 text-2xl font-bold">All Quotes</h2>

    <div class="mb-4 flex justify-end">
        <input type="text" id="quoteSearch" placeholder="Search by user name..."
               class="border rounded px-3 py-2 w-64 focus:outline-none focus:ring focus:border-blue-300" />
    </div>

    <div class="overflow-x-auto bg-white rounded-xl shadow p-6">
        <table class="min-w-full divide-y divide-gray-200" id="quotesTable">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quote #</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Customer</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($quotes as $quote)
                <tr>
                    <td class="px-4 py-3">{{ $quote->id }}</td>
                    <td class="px-4 py-3">{{ $quote->user->name ?? 'Guest' }}</td>
                    <td class="px-4 py-3">{{ $quote->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-4 py-3">{{ ucfirst($quote->status ?? 'pending') }}</td>
                    <td class="px-4 py-3">₱{{ number_format($quote->total, 2) }}</td>
                    <td class="px-4 py-3">
                        <button type="button"
                            class="inline-block px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition btn-view-quote"
                            data-id="{{ $quote->id }}">View</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-400">No quotes found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            {{ $quotes->links() }}
        </div>
    </div>
</div>

<!-- Quote Details Modal (Tailwind) -->
<div id="quoteModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-40">
    <div class="min-h-full flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full p-6 relative">
            <button id="closeQuoteModal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
            <div id="quoteModalContent" class="min-h-[120px] flex items-center justify-center text-gray-500">
                Loading...
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function(){
    // open
    document.querySelectorAll('.btn-view-quote').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const modal = document.getElementById('quoteModal');
            const content = document.getElementById('quoteModalContent');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            content.textContent = 'Loading...';

            fetch(`/admin/quotes/${id}`)
                .then(r => r.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    const main = doc.querySelector('main') || doc.body;
                    content.innerHTML = main.innerHTML;
                })
                .catch(() => content.textContent = 'Failed to load quote details.');
        });
    });

    // close
    const close = () => {
        const modal = document.getElementById('quoteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    document.getElementById('closeQuoteModal').addEventListener('click', close);
    window.addEventListener('keydown', e => { if(e.key === 'Escape') close(); });

    // search
    document.getElementById('quoteSearch').addEventListener('input', function() {
        const search = this.value.toLowerCase();
        document.querySelectorAll('#quotesTable tbody tr').forEach(row => {
            const nameCell = row.querySelector('td:nth-child(2)');
            if (!nameCell) return;
            row.style.display = nameCell.textContent.toLowerCase().includes(search) ? '' : 'none';
        });
    });
})();
</script>
@endpush
@endsection