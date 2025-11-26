@php
    use App\Models\Order;
    use App\Models\Quote;
@endphp

@extends('layouts.ecommerce')

@section('content')
<div class="py-8">
    @php
        $user = auth()->user();
        $isMarketing = $user && $user->role === 'employee' && $user->department === 'marketing';
    @endphp

    {{-- ========= TOP: QUOTE CHARTS ========= --}}
    <div class="w-full max-w-6xl mx-auto mb-8">
        @if($isMarketing)
            @php
                $db = config('database.default');
                $Y = $db === 'sqlite' ? "cast(strftime('%Y', created_at) as integer)" : "YEAR(created_at)";
                $M = $db === 'sqlite' ? "cast(strftime('%m', created_at) as integer)" : "MONTH(created_at)";
                $Q = $db === 'sqlite' ? "((cast(strftime('%m', created_at) as integer)+2)/3)" : "QUARTER(created_at)";
                $W = $db === 'sqlite' ? "cast(strftime('%W', created_at) as integer)" : "WEEK(created_at, 3)";

                $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

                // ---- QUOTES CREATED ----
                $quotesByWeek = Quote::whereYear('created_at', now()->year)
                    ->selectRaw("$W as w, COUNT(*) as c")->groupBy('w')->get();
                $quotesByMonth = Quote::whereYear('created_at', now()->year)
                    ->selectRaw("$M as m, COUNT(*) as c")->groupBy('m')->get();
                $quotesByQuarter = Quote::whereYear('created_at', now()->year)
                    ->selectRaw("$Q as q, COUNT(*) as c")->groupBy('q')->get();
                $quotesByYear = Quote::selectRaw("$Y as y, COUNT(*) as c")->groupBy('y')->get();

                // ---- QUOTES CONVERTED = ORDERS (treat orders as conversions) ----
                $ordersByWeekConv = Order::whereYear('created_at', now()->year)
                    ->selectRaw("$W as w, COUNT(*) as c")->groupBy('w')->get();
                $ordersByMonthConv = Order::whereYear('created_at', now()->year)
                    ->selectRaw("$M as m, COUNT(*) as c")->groupBy('m')->get();
                $ordersByQuarterConv = Order::whereYear('created_at', now()->year)
                    ->selectRaw("$Q as q, COUNT(*) as c")->groupBy('q')->get();
                $ordersByYearConv = Order::selectRaw("$Y as y, COUNT(*) as c")->groupBy('y')->get();

                // ---- STATUS MIX ----
                $quoteStatusCountsAll = Quote::selectRaw('status, COUNT(*) as cnt')->groupBy('status')->pluck('cnt','status');
                $quoteStatusCountsYear = Quote::whereYear('created_at', now()->year)
                    ->selectRaw('status, COUNT(*) as cnt')->groupBy('status')->pluck('cnt','status');

                // ---- WEEKLY ARRAYS ----
                $weeklyLabels    = array_map(fn($w)=>'W'.$w, range(1,53));
                $weeklyCreated   = array_fill(0,53,0);
                $weeklyConverted = array_fill(0,53,0);

                foreach ($quotesByWeek as $r) {
                    $i = max(1,(int)$r->w) - 1;
                    if($i>=0 && $i<53) $weeklyCreated[$i] = (int)$r->c;
                }
                foreach ($ordersByWeekConv as $r) {
                    $i = max(1,(int)$r->w) - 1;
                    if($i>=0 && $i<53) $weeklyConverted[$i] = (int)$r->c;
                }

                // ---- MONTHLY ARRAYS ----
                $monthlyCreated   = array_fill(0,12,0);
                $monthlyConverted = array_fill(0,12,0);
                foreach ($quotesByMonth as $r) {
                    $i = (int)$r->m - 1;
                    if($i>=0 && $i<12) $monthlyCreated[$i] = (int)$r->c;
                }
                foreach ($ordersByMonthConv as $r) {
                    $i = (int)$r->m - 1;
                    if($i>=0 && $i<12) $monthlyConverted[$i] = (int)$r->c;
                }

                // ---- QUARTERLY ARRAYS ----
                $quarterLabels    = ['Q1','Q2','Q3','Q4'];
                $quarterCreated   = array_fill(0,4,0);
                $quarterConverted = array_fill(0,4,0);
                foreach ($quotesByQuarter as $r){
                    $i = (int)$r->q - 1;
                    if($i>=0 && $i<4) $quarterCreated[$i] = (int)$r->c;
                }
                foreach ($ordersByQuarterConv as $r){
                    $i = (int)$r->q - 1;
                    if($i>=0 && $i<4) $quarterConverted[$i] = (int)$r->c;
                }

                // ---- YEARLY ARRAYS ----
                $yRowsQuotes = $quotesByYear->sortBy('y')->values();
                $yearlyLabels = [];
                $yearlyCreated = [];
                foreach($yRowsQuotes as $r){
                    $yearlyLabels[]  = (string)$r->y;
                    $yearlyCreated[] = (int)$r->c;
                }

                $yRowsOrders = $ordersByYearConv->sortBy('y')->values();
                $yearlyConverted = [];
                foreach ($yRowsOrders as $r) {
                    $yearlyConverted[] = (int)$r->c;
                }

                $qDatasets = [
                    'weekly'=>[
                        'labels'   => $weeklyLabels,
                        'created'  => $weeklyCreated,
                        'converted'=> $weeklyConverted,
                        'status'   => $quoteStatusCountsYear,
                    ],
                    'monthly'=>[
                        'labels'   => $months,
                        'created'  => $monthlyCreated,
                        'converted'=> $monthlyConverted,
                        'status'   => $quoteStatusCountsYear,
                    ],
                    'quarterly'=>[
                        'labels'   => $quarterLabels,
                        'created'  => $quarterCreated,
                        'converted'=> $quarterConverted,
                        'status'   => $quoteStatusCountsYear,
                    ],
                    'yearly'=>[
                        'labels'   => $yearlyLabels,
                        'created'  => $yearlyCreated,
                        'converted'=> $yearlyConverted,
                        'status'   => $quoteStatusCountsAll,
                    ],
                ];
            @endphp

            <div class="mb-3 flex justify-end">
                <label for="mkTimeframe" class="text-sm text-gray-600 mr-2 self-center">Timeframe:</label>
                <select id="mkTimeframe" class="border rounded-md px-3 py-1.5 text-sm">
                    <option value="weekly">Weekly ({{ now()->year }})</option>
                    <option value="monthly" selected>Monthly ({{ now()->year }})</option>
                    <option value="quarterly">Quarterly ({{ now()->year }})</option>
                    <option value="yearly">Yearly (All)</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl shadow p-4">
                    <div class="font-bold text-green-800 mb-2 text-center">Quotes Created</div>
                    <div class="h-48"><canvas id="qCreatedBar"></canvas></div>
                </div>

                <div class="bg-white rounded-xl shadow p-4">
                    <div class="font-bold text-green-800 mb-2 text-center">Quotes Converted</div>
                    <div class="h-48"><canvas id="qConvertedBar"></canvas></div>
                </div>

                <div class="bg-white rounded-xl shadow p-4">
                    <div class="font-bold text-green-800 mb-2 text-center">Quote Status Mix</div>
                    <div class="h-40"><canvas id="qStatusPie"></canvas></div>
                </div>
            </div>
        @endif
    </div>

    {{-- ========= ACTION BUTTONS ========= --}}
    <div class="w-full max-w-6xl mx-auto mb-8">
        @if($isMarketing)
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <a href="{{ route('employee.quotes.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#dbeafe"/>
                        <path d="M8 11h8M8 14h5" stroke="#2563eb" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-blue-600">Quote Management</div>
                    <div class="text-xs text-gray-500 mt-1">View and manage customer quotes</div>
                </a>

                <a href="{{ route('employee.orders.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#ede9fe"/>
                        <path d="M8 11h8M8 14h5" stroke="#7c3aed" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-purple-600">Order Management</div>
                    <div class="text-xs text-gray-500 mt-1">View and manage orders</div>
                </a>

                <a href="{{ route('employee.products.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-green-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#bbf7d0"/>
                        <path d="M12 10v4m2-2h-4" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-green-700">Add Product</div>
                    <div class="text-xs text-gray-500 mt-1">Add a new product to the ecommerce website</div>
                </a>

                <a href="{{ route('employee.inquiries.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#fff7ed"/>
                        <path d="M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2" stroke="#f97316"/>
                        <circle cx="8" cy="13" r="2" fill="#f97316"/>
                        <rect x="12" y="11" width="6" height="4" rx="1" fill="#fed7aa"/>
                    </svg>
                    <div class="font-bold text-orange-500">Product Inquiries</div>
                    <div class="text-xs text-gray-500 mt-1">View and manage product inquiries</div>
                </a>

                <a href="{{ route('employee.marketing.faqs') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-teal-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#ccfbf1"/>
                        <path d="M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2" stroke="#14b8a6"/>
                        <path d="M8 11h8M8 14h6" stroke="#0f766e" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-teal-600">FAQ Management</div>
                    <div class="text-xs text-gray-500 mt-1">Create and edit FAQs shown on the user homepage</div>
                </a>

                <a href="{{ route('employee.marketing.polls') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#fff7ed"/>
                        <path d="M8 11h8M8 14h5" stroke="#f59e0b" stroke-linecap="round"/>
                        <circle cx="18" cy="18" r="3" fill="#f59e0b"/>
                    </svg>
                    <div class="font-bold text-amber-600">Polls & Surveys</div>
                    <div class="text-xs text-gray-500 mt-1">Create polls that appear on the homepage (manage options/results)</div>
                </a>

                <a href="{{ route('employee.marketing.tips') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#ecfdf5"/>
                        <path d="M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2" stroke="#059669"/>
                        <path d="M12 10l3 3m0 0l-3 3m3-3H8" stroke="#059669" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="font-bold text-emerald-600">Tips & Reminders</div>
                    <div class="text-xs text-gray-500 mt-1">Manage helpful tips and reminders shown to users</div>
                </a>
            </div>
        @endif
    </div>

    {{-- ========= PRODUCT STOCK COUNT (UNDER BUTTONS) ========= --}}
    @if($isMarketing)
        <div class="w-full max-w-6xl mx-auto mb-10">
            @include('dashboard.employee_product_stats')
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.__DASH_BUILT__) return;
    window.__DASH_BUILT__ = true;

    var IS_MARKETING = @json($isMarketing);

    const $id = id => document.getElementById(id);

    // ===== QUOTE CHARTS =====
    if (IS_MARKETING) {
        const DS = @json($qDatasets ?? []);

        const ctxCreated   = $id('qCreatedBar')?.getContext('2d');
        const ctxConverted = $id('qConvertedBar')?.getContext('2d');
        const ctxQStatus   = $id('qStatusPie')?.getContext('2d');

        let createdChart, convertedChart, qStatusChart;

        function buildQuoteCharts(tf = 'monthly') {
            const d = DS[tf] || {labels:[], created:[], converted:[], status:{}};

            if (ctxCreated) {
                if (createdChart) createdChart.destroy();
                createdChart = new Chart(ctxCreated, {
                    type: 'bar',
                    data: {
                        labels: d.labels,
                        datasets: [{
                            label: 'Quotes Created',
                            data: d.created,
                            backgroundColor: '#3b82f6'
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                    }
                });
            }

            if (ctxConverted) {
                if (convertedChart) convertedChart.destroy();
                convertedChart = new Chart(ctxConverted, {
                    type: 'bar',
                    data: {
                        labels: d.labels,
                        datasets: [{
                            label: 'Quotes Converted',
                            data: d.converted,
                            backgroundColor: '#16a34a'
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                    }
                });
            }

            if (ctxQStatus) {
                if (qStatusChart) qStatusChart.destroy();
                const sLabels = Object.keys(d.status || {});
                const sValues = Object.values(d.status || {});
                qStatusChart = new Chart(ctxQStatus, {
                    type: 'doughnut',
                    data: {
                        labels: sLabels,
                        datasets: [{
                            data: sValues,
                            backgroundColor: [
                                '#22c55e','#f59e0b','#ef4444',
                                '#3b82f6','#a855f7','#64748b'
                            ]
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        cutout: '65%',
                        plugins: { legend: { position: 'bottom' } }
                    }
                });
            }
        }

        buildQuoteCharts('monthly');
        $id('mkTimeframe')?.addEventListener('change', e => buildQuoteCharts(e.target.value));
    }

    // ===== LIVE SEARCH: PRODUCT STOCK COUNT =====
    const stockSearch = document.getElementById('product-stock-search');
    if (stockSearch) {
        const rows = document.querySelectorAll('#product-stock-table .stock-row');
        stockSearch.addEventListener('input', function () {
            const term = this.value.toLowerCase();
            rows.forEach(row => {
                const name = (row.dataset.name || '').toLowerCase();
                row.style.display = !term || name.includes(term) ? '' : 'none';
            });
        });
    }
});
</script>
@endpush
