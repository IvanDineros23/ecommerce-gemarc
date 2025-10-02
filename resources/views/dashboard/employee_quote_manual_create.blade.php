@extends('layouts.app')
@section('title', 'Create Manual Quote | Gemarc Enterprises Inc.')
@section('content')
<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-8 text-center">
        <h1 class="text-3xl font-bold text-purple-800 mb-2">Create Manual Quote</h1>
        <p class="text-gray-700">Fill out all fields to create a manual quote. All details are manually inputted, including employee name.</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6 max-w-3xl mx-auto">
        <div class="flex flex-wrap gap-2 mb-4 justify-end">
            <button type="button" onclick="window.print()" class="bg-yellow-500 text-black px-5 py-2 rounded shadow hover:bg-yellow-600 font-bold">Print PDF</button>
            <button type="button" onclick="saveAsPDF()" class="bg-white text-black px-5 py-2 rounded shadow hover:bg-gray-200 font-bold border border-gray-400">Save PDF</button>
        </div>
        <form method="POST" action="{{ route('employee.quotes.manual.create') }}" class="flex flex-wrap gap-4 items-end">
            @csrf
            <div class="flex flex-col w-full sm:w-1/2">
                <label class="font-semibold mb-1">Employee Name</label>
                <input type="text" name="employee_name" class="border rounded p-2 min-w-[200px]" required placeholder="Enter employee name">
            </div>
            <div class="flex flex-col w-full sm:w-1/2">
                <label class="font-semibold mb-1">Customer Name</label>
                <input type="text" name="customer_name" class="border rounded p-2 min-w-[200px]" required placeholder="Enter customer name">
            </div>
            <div class="flex flex-col w-full sm:w-1/2">
                <label class="font-semibold mb-1">Customer Email</label>
                <input type="email" name="customer_email" class="border rounded p-2 min-w-[200px]" required placeholder="Enter customer email">
            </div>
            <div class="flex flex-col w-full sm:w-1/2">
                <label class="font-semibold mb-1">Customer Address</label>
                <input type="text" name="customer_address" class="border rounded p-2 min-w-[200px]" required placeholder="Enter customer address">
            </div>
            <div class="flex flex-col w-full sm:w-1/2">
                <label class="font-semibold mb-1">Contact Number</label>
                <input type="text" name="customer_contact" class="border rounded p-2 min-w-[200px]" required placeholder="Enter contact number">
            </div>
            <div class="flex flex-col w-full">
                <label class="font-semibold mb-1">Quote Items (add at least one)</label>
                <div id="manual-quote-items-list" class="space-y-2 mb-2"></div>
                <button type="button" id="add-manual-quote-item" class="bg-green-500 text-white px-3 py-1 rounded shadow hover:bg-green-600 transition">+ Add Item</button>
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 font-bold">Create Manual Quote</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function saveAsPDF() {
    const element = document.querySelector('.bg-white.rounded-xl.shadow');
    if (window.html2pdf) {
        html2pdf().from(element).set({
            margin: 0.5,
            filename: 'manual-quote.pdf',
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        }).save();
    } else {
        alert('PDF library not loaded. Please use the Print PDF button and select "Save as PDF" in your browser.');
    }
}
// Manual quote item adder for create form
document.addEventListener('DOMContentLoaded', function() {
    const addBtn = document.getElementById('add-manual-quote-item');
    const list = document.getElementById('manual-quote-items-list');
    let idx = 0;
    if (addBtn && list) {
        addBtn.addEventListener('click', function() {
            const row = document.createElement('div');
            row.className = 'flex flex-wrap items-center gap-2 item-row bg-gray-50 p-2 rounded';
            row.innerHTML = `
                <input type="text" name="items[${idx}][name]" class="border rounded p-2 min-w-[180px]" required placeholder="Item name">
                <input type="number" name="items[${idx}][quantity]" value="1" min="1" class="border rounded p-2 w-20 min-w-[80px]" required placeholder="Qty">
                <input type="number" name="items[${idx}][unit_price]" value="0" min="0" step="0.01" class="border rounded p-2 w-28 min-w-[100px]" required placeholder="Unit Price">
                <button type="button" class="remove-item bg-red-500 text-white px-2 py-1 rounded">Remove</button>
            `;
            list.appendChild(row);
            idx++;
        });
        list.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('.item-row').remove();
            }
        });
    }
});
</script>
@endsection