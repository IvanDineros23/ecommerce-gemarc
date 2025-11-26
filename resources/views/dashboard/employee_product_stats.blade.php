@php
    $products = $products ?? \App\Models\Product::orderBy('name')->get(['id','name','stock']);
@endphp

<div class="bg-white rounded-xl shadow p-4 h-full flex flex-col">
    <div class="font-bold text-green-800 mb-2 text-center">Product Stock Count</div>

    <div class="mb-3 flex justify-end">
        <input
            type="text"
            id="product-search"
            class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-full md:w-72 lg:w-80 focus:outline-none focus:ring-2 focus:ring-green-500"
            placeholder="Search product..."
        >
    </div>

    <div class="overflow-x-auto flex-1" style="max-height: 340px; min-height: 120px;">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-gray-100 sticky top-0">
                    <th class="px-3 py-2 text-left">Product Name</th>
                    <th class="px-3 py-2 text-right">Stock</th>
                </tr>
            </thead>
            <tbody id="product-table-body">
                @foreach($products as $product)
                    <tr class="stock-row" data-name="{{ strtolower($product->name) }}">
                        <td class="px-3 py-2">{{ $product->name }}</td>
                        <td class="px-3 py-2 text-right">{{ $product->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="no-results" class="text-center text-gray-400 mt-4 hidden">
        No products found.
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('product-search');
    const tableBody   = document.getElementById('product-table-body');
    const noResults   = document.getElementById('no-results');

    if (!searchInput || !tableBody) return;

    const rows = Array.from(tableBody.querySelectorAll('.stock-row'));

    function applyFilter() {
        const term = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            const name = (row.dataset.name || '').toLowerCase();
            if (!term || name.includes(term)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    searchInput.addEventListener('input', applyFilter);
});
</script>
