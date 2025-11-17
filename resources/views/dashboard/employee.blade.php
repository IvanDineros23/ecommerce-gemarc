@php
    use App\Models\Order;
    use App\Models\Quote;

    // ---- Marketing datasets safe-fallback ({} instead of []) ----
    $mkDS = isset($mkDatasets) ? $mkDatasets : new \stdClass();

    // Only marketing dashboard remains
@endphp

@extends('layouts.ecommerce')

@section('content')
<div class="py-8">
    {{-- Header --}}
    {{-- Top: visualizations will appear first for marketing employees (no welcome text) --}}

    @php
        $user = auth()->user();
        // $isPurchasing removed
        $isMarketing  = $user && $user->role === 'employee' && $user->department === 'marketing';
        // $isAccounting fully removed
    @endphp

    {{-- ========= VISUALIZATIONS (TOP) ========= --}}
    <div class="w-full max-w-6xl mx-auto mb-6">
        @if($isMarketing)
            @php
                // Build quote-focused datasets (weekly/monthly/quarterly/yearly aggregation)
                $db = config('database.default');
                $Y = $db === 'sqlite' ? "cast(strftime('%Y', created_at) as integer)" : "YEAR(created_at)";
                $M = $db === 'sqlite' ? "cast(strftime('%m', created_at) as integer)" : "MONTH(created_at)";
                $Q = $db === 'sqlite' ? "((cast(strftime('%m', created_at) as integer)+2)/3)" : "QUARTER(created_at)";
                $W = $db === 'sqlite' ? "cast(strftime('%W', created_at) as integer)" : "WEEK(created_at, 3)";

                $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

                $quotesByWeek = \App\Models\Quote::whereYear('created_at', now()->year)
                    ->selectRaw("$W as w, COUNT(*) as c")->groupBy('w')->get();
                $quotesByMonth = \App\Models\Quote::whereYear('created_at', now()->year)
                    ->selectRaw("$M as m, COUNT(*) as c")->groupBy('m')->get();
                $quotesByQuarter = \App\Models\Quote::whereYear('created_at', now()->year)
                    ->selectRaw("$Q as q, COUNT(*) as c")->groupBy('q')->get();
                $quotesByYear = \App\Models\Quote::selectRaw("$Y as y, COUNT(*) as c")->groupBy('y')->get();

                $quotesConvertedByWeek = \App\Models\Quote::whereHas('order')->whereYear('created_at', now()->year)
                    ->selectRaw("$W as w, COUNT(*) as c")->groupBy('w')->get();
                $quotesConvertedByMonth = \App\Models\Quote::whereHas('order')->whereYear('created_at', now()->year)
                    ->selectRaw("$M as m, COUNT(*) as c")->groupBy('m')->get();
                $quotesConvertedByQuarter = \App\Models\Quote::whereHas('order')->whereYear('created_at', now()->year)
                    ->selectRaw("$Q as q, COUNT(*) as c")->groupBy('q')->get();

                $quoteStatusCountsAll = \App\Models\Quote::selectRaw('status, COUNT(*) as cnt')->groupBy('status')->pluck('cnt','status');
                $quoteStatusCountsYear = \App\Models\Quote::whereYear('created_at', now()->year)
                    ->selectRaw('status, COUNT(*) as cnt')->groupBy('status')->pluck('cnt','status');

                // prepare empty containers
                $weeklyLabels = array_map(fn($w)=>'W'.$w, range(1,53));
                $weeklyCreated = array_fill(0,53,0);
                $weeklyConverted = array_fill(0,53,0);
                foreach ($quotesByWeek as $r) { $i=max(1,(int)$r->w)-1; if($i>=0&&$i<53) $weeklyCreated[$i]=(int)$r->c; }
                foreach ($quotesConvertedByWeek as $r) { $i=max(1,(int)$r->w)-1; if($i>=0&&$i<53) $weeklyConverted[$i]=(int)$r->c; }

                $monthlyCreated = array_fill(0,12,0);
                $monthlyConverted = array_fill(0,12,0);
                foreach ($quotesByMonth as $r) { $i=(int)$r->m-1; if($i>=0&&$i<12) $monthlyCreated[$i]=(int)$r->c; }
                foreach ($quotesConvertedByMonth as $r) { $i=(int)$r->m-1; if($i>=0&&$i<12) $monthlyConverted[$i]=(int)$r->c; }

                $quarterLabels = ['Q1','Q2','Q3','Q4'];
                $quarterCreated = array_fill(0,4,0);
                $quarterConverted = array_fill(0,4,0);
                foreach ($quotesByQuarter as $r){ $i=(int)$r->q-1; if($i>=0&&$i<4) $quarterCreated[$i]=(int)$r->c; }
                foreach ($quotesConvertedByQuarter as $r){ $i=(int)$r->q-1; if($i>=0&&$i<4) $quarterConverted[$i]=(int)$r->c; }

                $yRows = $quotesByYear->sortBy('y')->values();
                $yearlyLabels=[]; $yearlyCounts=[];
                foreach($yRows as $r){ $yearlyLabels[]=(string)$r->y; $yearlyCounts[]=(int)$r->c; }

                $qDatasets = [
                    'weekly'=>['labels'=>$weeklyLabels,'created'=>$weeklyCreated,'converted'=>$weeklyConverted,'status'=>$quoteStatusCountsYear],
                    'monthly'=>['labels'=>$months,'created'=>$monthlyCreated,'converted'=>$monthlyConverted,'status'=>$quoteStatusCountsYear],
                    'quarterly'=>['labels'=>$quarterLabels,'created'=>$quarterCreated,'converted'=>$quarterConverted,'status'=>$quoteStatusCountsYear],
                    'yearly'=>['labels'=>$yearlyLabels,'created'=>$yearlyCounts,'converted'=>array_fill(0,count($yearlyLabels),0),'status'=>$quoteStatusCountsAll]
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

    {{-- ========= ACTION BUTTONS (TOP) ========= --}}
    <div class="w-full max-w-6xl mx-auto">
        {{-- Only show for marketing department --}}
        @if($isMarketing)
            {{-- 3 equal cards; icon → title → desc --}}
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
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#fff7ed"/><path d="M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2" stroke="#f97316"/><circle cx="8" cy="13" r="2" fill="#f97316"/><rect x="12" y="11" width="6" height="4" rx="1" fill="#fed7aa"/>
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

    {{-- ========= CHARTS ========= --}}
@if($isMarketing)
    @php
        $db = config('database.default');

        // Helpers: period extractors for MySQL/SQLite
        $Y = $db === 'sqlite' ? "cast(strftime('%Y', created_at) as integer)" : "YEAR(created_at)";
        $M = $db === 'sqlite' ? "cast(strftime('%m', created_at) as integer)" : "MONTH(created_at)";
        $Q = $db === 'sqlite' ? "((cast(strftime('%m', created_at) as integer)+2)/3)" : "QUARTER(created_at)";
        $W = $db === 'sqlite' ? "cast(strftime('%W', created_at) as integer)" : "WEEK(created_at, 3)";

        // ---- COUNT: ALL ORDERS (any status) ----
        $ordersByMonth = \App\Models\Order::whereYear('created_at', now()->year)
            ->selectRaw("$M as m, COUNT(*) as c")->groupBy('m')->get();
        $ordersByQuarter = \App\Models\Order::whereYear('created_at', now()->year)
            ->selectRaw("$Q as q, COUNT(*) as c")->groupBy('q')->get();
        $ordersByWeek = \App\Models\Order::whereYear('created_at', now()->year)
            ->selectRaw("$W as w, COUNT(*) as c")->groupBy('w')->get();
        $ordersByYear = \App\Models\Order::selectRaw("$Y as y, COUNT(*) as c")->groupBy('y')->get();

        // ---- MONEY: only paid/done (more realistic billing) ----
        // try to include common "done" aliases
        $doneSet = ['paid','done','completed','complete'];
        $billingQ = \App\Models\Order::whereIn('status', $doneSet);

        $moneyMonth = (clone $billingQ)->whereYear('created_at', now()->year)
            ->selectRaw("$M as m, SUM(total_amount) as s")->groupBy('m')->get();
        $moneyQuarter = (clone $billingQ)->whereYear('created_at', now()->year)
            ->selectRaw("$Q as q, SUM(total_amount) as s")->groupBy('q')->get();
        $moneyWeek = (clone $billingQ)->whereYear('created_at', now()->year)
            ->selectRaw("$W as w, SUM(total_amount) as s")->groupBy('w')->get();
        $moneyYear = (clone $billingQ)
            ->selectRaw("$Y as y, SUM(total_amount) as s")->groupBy('y')->get();

        // ---- Order status mix (unchanged) ----
        $statusCountsMonthly = \App\Models\Order::whereYear('created_at', now()->year)
            ->selectRaw('status, COUNT(*) as cnt')->groupBy('status')->pluck('cnt','status');
        $statusCountsWeekly = $statusCountsMonthly;
        $statusCountsQuarterly = $statusCountsMonthly;
        $statusCountsYearly = \App\Models\Order::selectRaw('status, COUNT(*) as cnt')->groupBy('status')->pluck('cnt','status');

        // ---- Build arrays ----
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        $weekly = ['labels'=>array_map(fn($w)=>'W'.$w, range(1,53)),
                   'orders'=>array_fill(0,53,0), 'billings'=>array_fill(0,53,0)];
        foreach ($ordersByWeek as $r) { $i=max(1,(int)$r->w)-1; if($i>=0&&$i<53) $weekly['orders'][$i]=(int)$r->c; }
        foreach ($moneyWeek   as $r) { $i=max(1,(int)$r->w)-1; if($i>=0&&$i<53) $weekly['billings'][$i]=(float)$r->s; }

        $monthly = ['labels'=>$months,
                    'orders'=>array_fill(0,12,0), 'billings'=>array_fill(0,12,0)];
        foreach ($ordersByMonth as $r){ $i=(int)$r->m-1; $monthly['orders'][$i]=(int)$r->c; }
        foreach ($moneyMonth   as $r){ $i=(int)$r->m-1; $monthly['billings'][$i]=(float)$r->s; }

        $quarterly = ['labels'=>['Q1','Q2','Q3','Q4'],
                      'orders'=>array_fill(0,4,0), 'billings'=>array_fill(0,4,0)];
        foreach ($ordersByQuarter as $r){ $i=(int)$r->q-1; if($i>=0&&$i<4) $quarterly['orders'][$i]=(int)$r->c; }
        foreach ($moneyQuarter   as $r){ $i=(int)$r->q-1; if($i>=0&&$i<4) $quarterly['billings'][$i]=(float)$r->s; }

        $yRows = $ordersByYear->sortBy('y')->values();
        $yMoney = $moneyYear->keyBy('y');
        $yearly = ['labels'=>[], 'orders'=>[], 'billings'=>[]];
        foreach ($yRows as $r){
            $yearly['labels'][] = (string)$r->y;
            $yearly['orders'][] = (int)$r->c;
            $yearly['billings'][] = (float)($yMoney[$r->y]->s ?? 0);
        }

        $mkDatasets = [
            'weekly'    => ['labels'=>$weekly['labels'],    'orders'=>$weekly['orders'],    'billings'=>$weekly['billings'],    'status'=>$statusCountsWeekly],
            'monthly'   => ['labels'=>$monthly['labels'],   'orders'=>$monthly['orders'],   'billings'=>$monthly['billings'],   'status'=>$statusCountsMonthly],
            'quarterly' => ['labels'=>$quarterly['labels'], 'orders'=>$quarterly['orders'], 'billings'=>$quarterly['billings'], 'status'=>$statusCountsQuarterly],
            'yearly'    => ['labels'=>$yearly['labels'],    'orders'=>$yearly['orders'],    'billings'=>$yearly['billings'],    'status'=>$statusCountsYearly],
        ];
    @endphp

    {{-- KPI cards removed for marketing dashboard (requested) --}}

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // prevent double-build if this stack is injected twice
    if (window.__DASH_BUILT__) return;
    window.__DASH_BUILT__ = true;

    // allow safe re-evaluation without "already declared"
    // var IS_PURCHASING removed
    var IS_MARKETING  = (typeof IS_MARKETING  !== 'undefined') ? IS_MARKETING  : @json($isMarketing);
    // var IS_ACCOUNTING removed

    const $ = id => document.getElementById(id);

    // Purchasing charts removed

        // ===== Marketing charts (quotes-focused) =====
    if (IS_MARKETING) {
        const DS = @json($qDatasets ?? []);
        const $ = id => document.getElementById(id);

        const ctxCreated = $('qCreatedBar')?.getContext('2d');
        const ctxConverted = $('qConvertedBar')?.getContext('2d');
        const ctxQStatus = $('qStatusPie')?.getContext('2d');

        let createdChart, convertedChart, qStatusChart;

        function buildQuoteCharts(tf='monthly'){
            const d = DS[tf] || {labels:[], created:[], converted:[], status:{}};

            if (ctxCreated) {
                if (createdChart) createdChart.destroy();
                createdChart = new Chart(ctxCreated, {
                    type:'bar',
                    data:{ labels:d.labels, datasets:[{ label:'Quotes Created', data:d.created, backgroundColor:'#3b82f6' }] },
                    options:{ maintainAspectRatio:false, responsive:true, plugins:{ legend:{display:false} }, scales:{ y:{ beginAtZero:true, ticks:{ precision:0 } } } }
                });
            }

            if (ctxConverted) {
                if (convertedChart) convertedChart.destroy();
                convertedChart = new Chart(ctxConverted, {
                    type:'bar',
                    data:{ labels:d.labels, datasets:[{ label:'Quotes Converted', data:d.converted, backgroundColor:'#16a34a' }] },
                    options:{ maintainAspectRatio:false, responsive:true, plugins:{ legend:{display:false} }, scales:{ y:{ beginAtZero:true, ticks:{ precision:0 } } } }
                });
            }

            if (ctxQStatus) {
                if (qStatusChart) qStatusChart.destroy();
                const sLabels = Object.keys(d.status||{});
                const sValues = Object.values(d.status||{});
                qStatusChart = new Chart(ctxQStatus, {
                    type:'doughnut',
                    data:{ labels:sLabels, datasets:[{ data:sValues, backgroundColor:['#22c55e','#f59e0b','#ef4444','#3b82f6','#a855f7','#64748b'] }] },
                    options:{ maintainAspectRatio:false, responsive:true, cutout:'65%', plugins:{ legend:{ position:'bottom' } } }
                });
            }
        }

        buildQuoteCharts('monthly');
        $('mkTimeframe')?.addEventListener('change', e => buildQuoteCharts(e.target.value));
    }

    // Accounting charts removed
});

</script>
@endpush

@endif
