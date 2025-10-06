{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="flex flex-wrap gap-4 mb-8 justify-center">
    <a href="{{ route('admin.orders') }}" class="px-4 py-2 rounded bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition">All Orders</a>
    <a href="{{ route('admin.quotes') }}" class="px-4 py-2 rounded bg-purple-700 text-white font-semibold shadow hover:bg-purple-800 transition">Quotes Management</a>
    <a href="{{ route('admin.products') }}" class="px-4 py-2 rounded bg-green-700 text-white font-semibold shadow hover:bg-green-800 transition">Manage Products</a>
    <a href="{{ route('admin.user_management') }}" class="px-4 py-2 rounded bg-gray-800 text-white font-semibold shadow hover:bg-gray-900 transition">User Management</a>
    <a href="{{ route('admin.audit') }}" class="px-4 py-2 rounded bg-yellow-600 text-white font-semibold shadow hover:bg-yellow-700 transition">Audit Log</a>
</div>

<!-- Enhanced analytics and info grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full mb-6">
    <!-- User & Order Growth Summary -->
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-lg font-bold mb-2">User & Order Growth</h2>
        <div class="text-xs text-gray-700 mb-1">Users this month: <span class="font-bold">{{ \App\Models\User::whereMonth('created_at', now()->month)->count() }}</span></div>
        <div class="text-xs text-gray-700 mb-1">Orders this month: <span class="font-bold">{{ \App\Models\Order::whereMonth('created_at', now()->month)->count() }}</span></div>
        <div class="text-xs text-gray-700 mb-1">Users this week: <span class="font-bold">{{ \App\Models\User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}</span></div>
        <div class="text-xs text-gray-700">Orders this week: <span class="font-bold">{{ \App\Models\Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}</span></div>
    </div>
    <!-- Top Selling Products -->
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-lg font-bold mb-2">Top Selling Products</h2>
        <ul class="text-xs text-gray-700 ml-2">
            @foreach(\App\Models\Product::withCount('orderItems')->orderByDesc('order_items_count')->take(5)->get() as $product)
                <li>{{ $product->name }} <span class="text-gray-500">({{ $product->order_items_count }} sold)</span></li>
            @endforeach
        </ul>
    </div>
    <!-- Recent Login Activity -->
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-lg font-bold mb-2">Recent Login Activity</h2>
        <ul class="text-xs text-gray-700 ml-2">
            @foreach(\App\Models\AuditLog::where('action', 'login')->latest()->take(5)->get() as $log)
                <li>{{ $log->actor ? $log->actor->name : 'Unknown' }} - {{ $log->created_at->format('Y-m-d H:i') }}</li>
            @endforeach
        </ul>
    </div>
    <!-- Pending Actions / Alerts -->
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-lg font-bold mb-2">Pending Actions & Alerts</h2>
        <ul class="text-xs text-gray-700 ml-2">
            <li>Pending Orders: <span class="font-bold">{{ \App\Models\Order::where('status', 'pending')->count() }}</span></li>
            <li>Unapproved Quotes: <span class="font-bold">{{ \App\Models\Quote::where('status', 'pending')->count() }}</span></li>
            <li>Low Stock Products: <span class="font-bold">{{ \App\Models\Product::where('stock', '<', 5)->count() }}</span></li>
        </ul>
    </div>
    <!-- System Usage Stats -->
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-lg font-bold mb-2">System Usage Stats</h2>
        <ul class="text-xs text-gray-700 ml-2">
            <li>Total Users: <span class="font-bold">{{ \App\Models\User::count() }}</span></li>
            <li>Total Products: <span class="font-bold">{{ \App\Models\Product::count() }}</span></li>
            <li>Total Orders: <span class="font-bold">{{ \App\Models\Order::count() }}</span></li>
            <li>Total Quotes: <span class="font-bold">{{ \App\Models\Quote::count() }}</span></li>
            <li>Total Audit Logs: <span class="font-bold">{{ \App\Models\AuditLog::count() }}</span></li>
        </ul>
    </div>
    <!-- System Health & Revenue (existing) -->
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-lg font-bold mb-2">System Health & Revenue</h2>
        <div class="mb-1">Failed Jobs: <span class="font-bold text-{{ 0 > 0 ? 'red-600' : 'green-600' }}">0</span></div>
        <div class="mb-1">Total Revenue: <span class="font-bold text-green-700">₱0.00</span></div>
    </div>
</div>

@include('admin.partials.dashboard-charts-scripts')
<script>
// Pie chart for order status (empty)
new Chart(document.getElementById('orderStatusChart').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: [],
        datasets: [{
            data: [],
            backgroundColor: ['#2563eb', '#f59e42', '#16a34a', '#a21caf', '#334155'],
        }]
    },
    options: { plugins: { legend: { display: true } } }
});

// Pie chart for quote status
new Chart(document.getElementById('quoteStatusChart').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: ['open'],
        datasets: [{
            data: [2],
            backgroundColor: ['#a21caf'],
        }]
    },
    options: { plugins: { legend: { display: true } } }
});
const usersProductsQuotesChart = document.getElementById('usersProductsQuotesChart').getContext('2d');
const ordersQuotesAuditChart = document.getElementById('ordersQuotesAuditChart').getContext('2d');

new Chart(usersProductsQuotesChart, {
    type: 'bar',
    data: {
        labels: ['Users', 'Products', 'Quotes'],
        datasets: [{
            label: 'Count',
            data: [{{ \App\Models\User::count() }}, {{ \App\Models\Product::count() }}, {{ \App\Models\Quote::count() }}],
            backgroundColor: ['#2563eb', '#16a34a', '#a21caf'],
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } }
    }
});

new Chart(ordersQuotesAuditChart, {
    type: 'bar',
    data: {
        labels: ['Orders', 'Quotes', 'Audit Logs'],
        datasets: [{
            label: 'Count',
            data: [{{ \App\Models\Order::count() }}, {{ \App\Models\Quote::count() }}, {{ \App\Models\AuditLog::count() }}],
            backgroundColor: ['#f59e42', '#a21caf', '#334155'],
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } }
    }
});
</script>
@endsection
