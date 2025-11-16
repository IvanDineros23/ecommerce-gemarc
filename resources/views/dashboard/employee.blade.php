@php
    use App\Models\Order;

    // ---- Marketing datasets safe-fallback ({} instead of []) ----
    $mkDS = isset($mkDatasets) ? $mkDatasets : new \stdClass();

    // Only marketing dashboard remains
@endphp

@extends('layouts.ecommerce')

@section('content')
<div class="py-8">
    {{-- Header --}}
    <div class="flex flex-col items-center justify-center mb-8 text-center">
        <h1 class="text-3xl font-bold text-green-800 mb-2">Employee Dashboard</h1>
        <p class="text-gray-700">Welcome, {{ auth()->user()->name }}! Manage products, inventory, and orders here.</p>
    </div>

    @php
        $user = auth()->user();
        // $isPurchasing removed
        $isMarketing  = $user && $user->role === 'employee' && $user->department === 'marketing';
        // $isAccounting fully removed
    @endphp

    {{-- ========= ACTION BUTTONS (TOP) ========= --}}
    <div class="w-full max-w-6xl mx-auto">
        {{-- Only show for marketing department --}}
        @if($isMarketing)
            {{-- 3 equal cards; icon → title → desc --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                {{-- Only marketing dashboard cards remain --}}
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

    {{-- Timeframe selector --}}
    <div class="w-full max-w-6xl mx-auto mb-3 flex items-center justify-end gap-2">
        <label for="mkTimeframe" class="text-sm text-gray-600">Timeframe:</label>
        <select id="mkTimeframe" class="border rounded-md px-3 py-1.5 text-sm">
            <option value="weekly">Weekly ({{ now()->year }})</option>
            <option value="monthly" selected>Monthly ({{ now()->year }})</option>
            <option value="quarterly">Quarterly ({{ now()->year }})</option>
            <option value="yearly">Yearly (All)</option>
        </select>
    </div>

    {{-- KPI cards --}}
    <div class="w-full max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4" id="mkKpis">
        <div class="bg-white rounded-xl shadow p-4">
            <div class="text-xs text-gray-500">Total Revenue</div>
            <div class="text-2xl font-bold text-green-700" id="kpiRevenue">₱0</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div class="text-xs text-gray-500">Total Orders</div>
            <div class="text-2xl font-bold text-slate-700" id="kpiOrders">0</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div class="text-xs text-gray-500">Avg Order Value</div>
            <div class="text-2xl font-bold text-emerald-700" id="kpiAov">₱0</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div class="text-xs text-gray-500">Paid Rate</div>
            <div class="text-2xl font-bold text-indigo-700" id="kpiPaidRate">0%</div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="w-full max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl shadow p-4">
            <div class="font-bold text-green-800 mb-2 text-center">Orders (Count)</div>
            <div class="h-48"><canvas id="mkOrdersBar"></canvas></div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div class="font-bold text-green-800 mb-2 text-center">Revenue (₱)</div>
            <div class="h-48"><canvas id="mkRevenueBar"></canvas></div>
        </div>
        <div class="bg-white rounded-xl shadow p-4 md:col-span-2">
            <div class="font-bold text-green-800 mb-2 text-center">Order Status Mix</div>
            <div class="h-56"><canvas id="mkStatusPie"></canvas></div>
        </div>
    </div>

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

    // ===== Marketing charts (updated logic) =====
    if (IS_MARKETING) {
        const DS = @json($mkDatasets ?? []);
        const peso = v => ' ₱' + (v||0).toLocaleString(undefined,{maximumFractionDigits:2});
        const $ = id => document.getElementById(id);

        const ctxOrders  = $('mkOrdersBar')?.getContext('2d');
        const ctxBill    = $('mkRevenueBar')?.getContext('2d'); // reuse canvas
        const ctxStatus  = $('mkStatusPie')?.getContext('2d');

        let ordersChart, billChart, statusChart;

        function setKpis(d){
            const totalOrd = (d.orders||[]).reduce((a,b)=>a+(+b||0),0);
            const totalBil = (d.billings||[]).reduce((a,b)=>a+(+b||0),0);
            const aov = totalOrd ? totalBil/totalOrd : 0;

            const s = d.status || {};
            const statusTotal = Object.values(s).reduce((a,b)=>a+(+b||0),0) || totalOrd;
            const paid = (s.paid || s.PAID || s.done || s.completed || 0);
            const paidRate = statusTotal ? Math.round((paid/statusTotal)*100) : (totalOrd?100:0);

            if ($('kpiRevenue')) $('kpiRevenue').textContent = '₱' + totalBil.toLocaleString(undefined,{maximumFractionDigits:2});
            if ($('kpiOrders'))  $('kpiOrders').textContent  = (totalOrd||0).toLocaleString();
            if ($('kpiAov'))     $('kpiAov').textContent     = '₱' + aov.toLocaleString(undefined,{maximumFractionDigits:2});
            if ($('kpiPaidRate'))$('kpiPaidRate').textContent= paidRate + '%';
        }

        function buildCharts(tf='monthly'){
            const d = DS[tf] || {labels:[], orders:[], billings:[], status:{}};
            setKpis(d);

            // Orders (all statuses)
            if (ctxOrders) {
                if (ordersChart) ordersChart.destroy();
                ordersChart = new Chart(ctxOrders, {
                    type:'bar',
                    data:{ labels:d.labels, datasets:[{ label:'Orders', data:d.orders, backgroundColor:'#3b82f6' }] },
                    options:{ maintainAspectRatio:false, responsive:true, plugins:{ legend:{display:false} },
                        scales:{ y:{ beginAtZero:true, ticks:{ precision:0 } } }
                    }
                });
            }

            // Billings (₱) – paid/done only
            if (ctxBill) {
                if (billChart) billChart.destroy();
                // update heading text if present
                const titleDiv = ctxBill.canvas.closest('.bg-white')?.querySelector('.font-bold');
                if (titleDiv) titleDiv.textContent = 'Billings (₱)';

                billChart = new Chart(ctxBill, {
                    type:'bar',
                    data:{ labels:d.labels, datasets:[{ label:'Billings (₱)', data:d.billings, backgroundColor:'#16a34a' }] },
                    options:{ maintainAspectRatio:false, responsive:true,
                        plugins:{ legend:{display:false}, tooltip:{ callbacks:{ label:c=>peso(c.parsed.y) } } },
                        scales:{ y:{ beginAtZero:true, ticks:{ callback:v=>'₱'+Number(v).toLocaleString() } } }
                    }
                });
            }

            // Status mix
            if (ctxStatus) {
                if (statusChart) statusChart.destroy();
                const sLabels = Object.keys(d.status||{});
                const sValues = Object.values(d.status||{});
                statusChart = new Chart(ctxStatus, {
                    type:'doughnut',
                    data:{ labels:sLabels, datasets:[{ data:sValues, backgroundColor:['#22c55e','#f59e0b','#ef4444','#3b82f6','#a855f7','#64748b'] }] },
                    options:{ maintainAspectRatio:false, responsive:true, plugins:{ legend:{ position:'bottom' } } }
                });
            }
        }

        buildCharts('monthly');
        $('mkTimeframe')?.addEventListener('change', e => buildCharts(e.target.value));
    }

    // Accounting charts removed
});

</script>
@endpush

@endif
