@php
    $products = $products ?? \App\Models\Product::orderBy('name')->get(['id','name','stock']);
@endphp

<div class="bg-white rounded-xl shadow p-4 h-full flex flex-col">
    <div class="font-bold text-green-800 mb-2 text-center">Product Stock Count</div>

    <div class="mb-3 flex flex-col md:flex-row md:items-center md:justify-end gap-2">
        <input
            type="text"
            id="product-search"
            class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-full md:w-72 lg:w-80 focus:outline-none focus:ring-2 focus:ring-green-500"
            placeholder="Search product..."
        >
        <select id="product-stock-filter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 w-full md:w-auto">
            <option value="all">All</option>
            <option value="low">Low Stock (≤ 2)</option>
            <option value="out">Out of Stock</option>
            <option value="in">In Stock (&gt; 2)</option>
        </select>
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
                    <tr class="stock-row" data-name="{{ strtolower($product->name) }}" data-stock="{{ (int)($product->stock ?? 0) }}">
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
    const filterInput = document.getElementById('product-stock-filter');
    const tableBody   = document.getElementById('product-table-body');
    const noResults   = document.getElementById('no-results');

    if (!searchInput || !tableBody || !filterInput) return;

    const rows = Array.from(tableBody.querySelectorAll('.stock-row'));

    function applyFilter() {
        const term = searchInput.value.trim().toLowerCase();
        const filter = filterInput.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const name = (row.dataset.name || '').toLowerCase();
            const stock = parseInt(row.dataset.stock || '0', 10);
            let show = true;
            if (term && !name.includes(term)) show = false;
            if (filter === 'low' && !(stock > 0 && stock <= 2)) show = false;
            if (filter === 'out' && stock !== 0) show = false;
            if (filter === 'in' && !(stock > 2)) show = false;
            row.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });

        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    searchInput.addEventListener('input', applyFilter);
    filterInput.addEventListener('change', applyFilter);
});
</script>
