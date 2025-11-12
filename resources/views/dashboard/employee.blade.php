@php
    use App\Models\Order;

    // ---- Marketing datasets safe-fallback ({} instead of []) ----
    $mkDS = isset($mkDatasets) ? $mkDatasets : new \stdClass();

    // ---- Precompute Accounting values into plain arrays ----
    $__months = $months ?? ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $__ar     = array_values($arBuckets       ?? ['0-30'=>0,'31-60'=>0,'61-90'=>0,'90+'=>0]);
    $__ap     = array_values($apBuckets       ?? ['0-30'=>0,'31-60'=>0,'61-90'=>0,'90+'=>0]);
    $__in     = $collectionsByMonth ?? array_fill(0,12,0);
    $__out    = $expensesByMonth    ?? array_fill(0,12,0);
    $__top    = $topCustomers       ?? [];
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
        $isPurchasing = $user && $user->role === 'employee' && $user->department === 'purchasing';
        $isMarketing  = $user && $user->role === 'employee' && $user->department === 'marketing';
        $isAccounting = $user && $user->role === 'employee' && $user->department === 'accounting';
    @endphp

    {{-- ========= ACTION BUTTONS (TOP) ========= --}}
    <div class="w-full max-w-6xl mx-auto">
        @if($isPurchasing)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                @php
                    $cards = [
                        ['route'=>'employee.products.index','title'=>'Product Management','desc'=>'Add, edit, or remove products','icon'=>'product','txt'=>'text-green-800','ico'=>'text-green-700'],
                        ['route'=>'employee.inventory.index','title'=>'Inventory','desc'=>'View and update stock levels','icon'=>'inventory','txt'=>'text-orange-600','ico'=>'text-orange-600'],
                        ['route'=>'employee.orders.index','title'=>'Order Management','desc'=>'Process and track orders','icon'=>'orders','txt'=>'text-green-800','ico'=>'text-green-800'],
                        ['route'=>'employee.chat.page','title'=>'Chat Management','desc'=>'View and manage chats','icon'=>'chat','txt'=>'text-blue-600','ico'=>'text-blue-600'],
                    ];
                @endphp

                @foreach($cards as $c)
                    <a href="{{ route($c['route']) }}"
                       class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                        {{-- ICON (smaller) --}}
                        @if($c['icon']==='product')
                            <svg class="w-10 h-10 mb-2 {{ $c['ico'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="7" width="18" height="13" rx="2" fill="#e0f2fe"/><path d="M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2" stroke="#38bdf8"/><circle cx="8" cy="13" r="2" fill="#38bdf8"/><rect x="12" y="11" width="6" height="4" rx="1" fill="#bae6fd"/>
                            </svg>
                        @elseif($c['icon']==='inventory')
                            <svg class="w-10 h-10 mb-2 {{ $c['ico'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="4" y="8" width="16" height="10" rx="2" fill="#fef9c3"/><path d="M4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2" stroke="#f59e0b"/><rect x="8" y="12" width="8" height="2" rx="1" fill="#fde68a"/>
                            </svg>
                        @elseif($c['icon']==='orders')
                            <svg class="w-10 h-10 mb-2 {{ $c['ico'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="4" y="6" width="16" height="12" rx="2" fill="#bbf7d0"/><path d="M8 10h8M8 14h5" stroke="#22c55e" stroke-linecap="round"/><circle cx="18" cy="18" r="3" fill="#22c55e"/><path d="M18 16v2l1 1" stroke="#fff" stroke-width="1.2" stroke-linecap="round"/>
                            </svg>
                        @else
                            <svg class="w-10 h-10 mb-2 {{ $c['ico'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="7" width="18" height="10" rx="2" fill="#dbeafe"/><path d="M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2" stroke="#2563eb"/><circle cx="8" cy="13" r="2" fill="#2563eb"/><rect x="12" y="11" width="6" height="4" rx="1" fill="#93c5fd"/>
                            </svg>
                        @endif

                        <div class="font-bold {{ $c['txt'] }}">{{ $c['title'] }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ $c['desc'] }}</div>
                    </a>
                @endforeach
            </div>

        @elseif($isMarketing)
            {{-- 3 equal cards; icon → title → desc --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <a href="{{ route('employee.quotes.management.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#ede9fe"/><path d="M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2" stroke="#7c3aed"/><circle cx="8" cy="13" r="2" fill="#7c3aed"/><rect x="12" y="11" width="6" height="4" rx="1" fill="#c4b5fd"/>
                    </svg>
                    <div class="font-bold text-purple-600">Quote Management</div>
                    <div class="text-xs text-gray-500 mt-1">View and manage quotes</div>
                </a>

                <a href="{{ route('employee.orders.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-green-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="4" y="6" width="16" height="12" rx="2" fill="#bbf7d0"/><path d="M8 10h8M8 14h5" stroke="#22c55e" stroke-linecap="round"/><circle cx="18" cy="18" r="3" fill="#22c55e"/><path d="M18 16v2l1 1" stroke="#fff" stroke-width="1.2" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-green-800">Order Management</div>
                    <div class="text-xs text-gray-500 mt-1">Process and track orders</div>
                </a>

                <a href="{{ route('employee.chat.page') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#dbeafe"/><path d="M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2" stroke="#2563eb"/><circle cx="8" cy="13" r="2" fill="#2563eb"/><rect x="12" y="11" width="6" height="4" rx="1" fill="#93c5fd"/>
                    </svg>
                    <div class="font-bold text-blue-600">Chat Management</div>
                    <div class="text-xs text-gray-500 mt-1">View and manage chats</div>
                </a>

                <a href="{{ route('employee.inquiries.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#fff7ed"/><path d="M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2" stroke="#f97316"/><circle cx="8" cy="13" r="2" fill="#f97316"/><rect x="12" y="11" width="6" height="4" rx="1" fill="#fed7aa"/>
                    </svg>
                    <div class="font-bold text-orange-500">Product Inquiries</div>
                    <div class="text-xs text-gray-500 mt-1">View and manage product inquiries</div>
                </a>
                
                {{-- Marketing-specific: FAQ & Poll management links --}}
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

        @elseif($isAccounting)
            {{-- ===== ACCOUNTING: ACTION CARDS ===== --}}
            <div class="w-full max-w-6xl mx-auto mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('employee.chat.page') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="10" rx="2" fill="#dbeafe"/><path d="M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2" stroke="#2563eb"/><circle cx="8" cy="13" r="2" fill="#2563eb"/><rect x="12" y="11" width="6" height="4" rx="1" fill="#93c5fd"/>
                    </svg>
                    <div class="font-bold text-blue-600">Chat Management</div>
                    <div class="text-xs text-gray-500 mt-1">View and manage chats</div>
                </a>

                <a href="{{ route('employee.invoices.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="4" y="3" width="16" height="18" rx="2" fill="#dcfce7"/><path d="M8 8h8M8 12h6M8 16h5" stroke="#10b981" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-emerald-700">Invoice Management</div>
                    <div class="text-xs text-gray-500 mt-1">Create, send, track invoices</div>
                </a>

                <a href="{{ route('employee.payments.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-green-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="9" fill="#bbf7d0"/><path d="M8 12h8M12 8v8" stroke="#16a34a" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-green-700">Payments Received</div>
                    <div class="text-xs text-gray-500 mt-1">Record & reconcile</div>
                </a>

                <a href="{{ route('employee.bills.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="5" width="18" height="14" rx="2" fill="#ffedd5"/><path d="M7 9h10M7 13h6" stroke="#f97316" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-orange-600">Bills / Payables</div>
                    <div class="text-xs text-gray-500 mt-1">Vendor bills & due dates</div>
                </a>

                <a href="{{ route('employee.expenses.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="4" y="4" width="16" height="16" rx="4" fill="#fee2e2"/><path d="M8 12h8" stroke="#ea580c" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-rose-600">Expenses</div>
                    <div class="text-xs text-gray-500 mt-1">OPEX & reimbursements</div>
                </a>

                <a href="{{ route('employee.credits.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="5" y="5" width="14" height="14" rx="3" fill="#ede9fe"/><path d="M9 12h6M12 9v6" stroke="#7c3aed" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-purple-600">Credit Notes / Refunds</div>
                    <div class="text-xs text-gray-500 mt-1">Issue & apply credits</div>
                </a>

                <a href="{{ route('employee.tax-reports.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M4 18V6a2 2 0 0 1 2-2h12" stroke="#0284c7"/><rect x="6" y="6" width="12" height="12" rx="2" fill="#e0f2fe"/><path d="M8 10h8M8 14h6" stroke="#0ea5e9" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-sky-600">Tax Reports</div>
                    <div class="text-xs text-gray-500 mt-1">VAT / Percentage tax</div>
                </a>

                <a href="{{ route('employee.statements.index') }}"
                   class="bg-white rounded-xl shadow p-6 flex flex-col items-center text-center hover:bg-green-50 transition min-h-[150px]">
                    <svg class="w-10 h-10 mb-2 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="18" height="16" rx="2" fill="#f1f5f9"/><path d="M7 9h10M7 13h8M7 17h6" stroke="#334155" stroke-linecap="round"/>
                    </svg>
                    <div class="font-bold text-slate-700">Statements</div>
                    <div class="text-xs text-gray-500 mt-1">P&L & Balance snapshot</div>
                </a>
            </div>
        @endif
    </div>

   {{-- ========= CHARTS ========= --}}
@if($isPurchasing)
    @php
        $products = \App\Models\Product::all();
        $stockLabels = $products->pluck('name')->map(fn($n)=>mb_strlen($n)>18?mb_substr($n,0,16).'…':$n)->values();
        $stockData   = $products->pluck('stock')->values();
        $valueData   = $products->map(fn($p)=>(float)$p->stock*(float)$p->unit_price)->values();
        $totalInventoryValue = $valueData->sum();
    @endphp

    <div class="w-full max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl shadow p-4">
            <div class="font-bold text-green-800 mb-2 text-center">Stock Levels</div>
            <div class="h-48"><canvas id="stockLevelsChart"></canvas></div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div class="font-bold text-green-800 mb-2 text-center">Inventory Value (Per Product)</div>
            <div class="h-48"><canvas id="inventoryValueChart"></canvas></div>
        </div>
        <div class="bg-white rounded-xl shadow p-4 md:col-span-2">
            <div class="font-bold text-green-800 mb-2 text-center">Total Inventory Value</div>
            <div class="h-48"><canvas id="inventoryValueTotalChart"></canvas></div>
            <div class="mt-3 text-center text-lg font-semibold text-green-700">
                ₱{{ number_format($totalInventoryValue, 2) }}
            </div>
        </div>
    </div>

@elseif($isMarketing)
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

    @elseif($isAccounting)
        @php
            $today = now()->startOfDay();

            // AR Aging
            $arBuckets = [ '0-30'=>0, '31-60'=>0, '61-90'=>0, '90+'=>0 ];
            if (\Illuminate\Support\Facades\Schema::hasTable('invoices')) {
                $invoicesQ = \App\Models\Invoice::query();
                if (\Illuminate\Support\Facades\Schema::hasColumn('invoices','status')) $invoicesQ->where('status','!=','paid');
                if (\Illuminate\Support\Facades\Schema::hasColumn('invoices','balance_due')) $invoicesQ->where('balance_due','>',0);
                foreach ($invoicesQ->get() as $inv) {
                    $due = \Illuminate\Support\Carbon::parse($inv->due_date ?? $inv->created_at);
                    $days = $due->diffInDays($today, false);
                    $amt  = (float)($inv->balance_due ?? $inv->total_amount ?? 0);
                    if ($days <= 30) $arBuckets['0-30'] += $amt;
                    elseif ($days <= 60) $arBuckets['31-60'] += $amt;
                    elseif ($days <= 90) $arBuckets['61-90'] += $amt;
                    else $arBuckets['90+'] += $amt;
                }
            }

            // AP Aging
            $apBuckets = [ '0-30'=>0, '31-60'=>0, '61-90'=>0, '90+'=>0 ];
            if (\Illuminate\Support\Facades\Schema::hasTable('bills')) {
                $bills = \App\Models\Bill::query();
                if (\Illuminate\Support\Facades\Schema::hasColumn('bills','status')) $bills->where('status','!=','paid');
                foreach ($bills->get() as $bill) {
                    $due = \Illuminate\Support\Carbon::parse($bill->due_date ?? $bill->created_at);
                    $days = $due->diffInDays($today, false);
                    $amt  = (float)($bill->balance_due ?? $bill->total_amount ?? 0);
                    if ($days <= 30) $apBuckets['0-30'] += $amt;
                    elseif ($days <= 60) $apBuckets['31-60'] += $amt;
                    elseif ($days <= 90) $apBuckets['61-90'] += $amt;
                    else $apBuckets['90+'] += $amt;
                }
            }

            // Collections & Expenses per month
            $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            $collectionsByMonth = array_fill(0,12,0);
            if (\Illuminate\Support\Facades\Schema::hasTable('payments')) {
                $p = \App\Models\Payment::selectRaw("MONTH(created_at) m, SUM(amount) s")
                    ->whereYear('created_at', now()->year)->groupBy('m')->get();
                foreach ($p as $row) $collectionsByMonth[((int)$row->m)-1] = (float)$row->s;
            } elseif (\Illuminate\Support\Facades\Schema::hasTable('orders')) {
                $p = \App\Models\Order::where('status','paid')
                    ->whereYear('created_at', now()->year)
                    ->selectRaw("MONTH(created_at) m, SUM(total_amount) s")->groupBy('m')->get();
                foreach ($p as $row) $collectionsByMonth[((int)$row->m)-1] = (float)$row->s;
            }

            $expensesByMonth = array_fill(0,12,0);
            if (\Illuminate\Support\Facades\Schema::hasTable('expenses')) {
                $e = \App\Models\Expense::whereYear('created_at', now()->year)
                     ->selectRaw("MONTH(created_at) m, SUM(amount) s")->groupBy('m')->get();
                foreach ($e as $row) $expensesByMonth[((int)$row->m)-1] = (float)$row->s;
            }

            $topCustomers = [];
            if (\Illuminate\Support\Facades\Schema::hasTable('payments')) {
                $topCustomers = \App\Models\Payment::selectRaw("(customer_id) cid, SUM(amount) s")
                    ->whereYear('created_at', now()->year)->groupBy('cid')->orderByDesc('s')->limit(5)->get()
                    ->map(fn($r)=>['name'=>'Customer '.$r->cid, 'sum'=>(float)$r->s])->toArray();
            }
        @endphp

        <div class="w-full max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-xl shadow p-4">
                <div class="font-bold text-green-800 mb-2 text-center">AR Aging (₱)</div>
                <div class="h-48"><canvas id="arAgingChart"></canvas></div>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <div class="font-bold text-green-800 mb-2 text-center">AP Aging (₱)</div>
                <div class="h-48"><canvas id="apAgingChart"></canvas></div>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <div class="font-bold text-green-800 mb-2 text-center">Collections vs Expenses (Monthly)</div>
                <div class="h-48"><canvas id="cashflowChart"></canvas></div>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <div class="font-bold text-green-800 mb-2 text-center">Top Customers by Collections</div>
                <div class="h-48"><canvas id="topCustomersChart"></canvas></div>
            </div>
        </div>
    @endif
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
    var IS_PURCHASING = (typeof IS_PURCHASING !== 'undefined') ? IS_PURCHASING : @json($isPurchasing);
    var IS_MARKETING  = (typeof IS_MARKETING  !== 'undefined') ? IS_MARKETING  : @json($isMarketing);
    var IS_ACCOUNTING = (typeof IS_ACCOUNTING !== 'undefined') ? IS_ACCOUNTING : @json($isAccounting);

    const $ = id => document.getElementById(id);

    // ===== Purchasing charts =====
    if (IS_PURCHASING) {
        const stockLabels = @json($stockLabels ?? []);
        const stockData   = @json($stockData   ?? []);
        const valueData   = @json($valueData   ?? []);
        const totalValue  = @json($totalInventoryValue ?? 0);

        if ($('stockLevelsChart')) {
            new Chart($('stockLevelsChart'), {
                type: 'bar',
                data: { labels: stockLabels, datasets: [{ label:'Stock', data: stockData, backgroundColor:'#38bdf8' }] },
                options: { maintainAspectRatio:false, responsive:true, plugins:{legend:{display:false}}, scales:{ y:{ beginAtZero:true } } }
            });
        }

        if ($('inventoryValueChart')) {
            new Chart($('inventoryValueChart'), {
                type: 'bar',
                data: { labels: stockLabels, datasets: [{ label:'Value (₱)', data: valueData, backgroundColor:'#22c55e' }] },
                options: {
                    maintainAspectRatio:false, responsive:true,
                    plugins:{ legend:{display:false}, tooltip:{ callbacks:{ label:c=>' ₱'+(c.parsed.y||0).toLocaleString() } } },
                    scales:{ y:{ beginAtZero:true, ticks:{ callback:v=>'₱'+Number(v).toLocaleString() } } }
                }
            });
        }

        if ($('inventoryValueTotalChart')) {
            new Chart($('inventoryValueTotalChart'), {
                type: 'bar',
                data: { labels:['Total Inventory Value'], datasets:[{ data:[totalValue], backgroundColor:'#16a34a' }] },
                options: {
                    maintainAspectRatio:false, responsive:true,
                    plugins:{ legend:{display:false}, tooltip:{ callbacks:{ label:c=>' ₱'+(c.parsed.y||0).toLocaleString() } } },
                    scales:{ x:{ grid:{display:false} }, y:{ beginAtZero:true, ticks:{ callback:v=>'₱'+Number(v).toLocaleString() } } }
                }
            });
        }
    }

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

    // ===== Accounting charts =====
    if (IS_ACCOUNTING) {
        const months  = @json($__months);
        const ar      = @json($__ar);
        const ap      = @json($__ap);
        const inflow  = @json($__in);
        const outflow = @json($__out);
        const top     = @json($__top);
        const peso = v => ' ₱' + (v||0).toLocaleString();

        if ($('arAgingChart')) {
            new Chart($('arAgingChart'), {
                type:'bar',
                data:{ labels:['0-30','31-60','61-90','90+'], datasets:[{ data: ar, backgroundColor:'#22c55e' }] },
                options:{ maintainAspectRatio:false,
                    plugins:{legend:{display:false}, tooltip:{callbacks:{label:c=>peso(c.parsed.y)}}},
                    scales:{ y:{ beginAtZero:true, ticks:{ callback:v=>'₱'+Number(v).toLocaleString() } } }
                }
            });
        }

        if ($('apAgingChart')) {
            new Chart($('apAgingChart'), {
                type:'bar',
                data:{ labels:['0-30','31-60','61-90','90+'], datasets:[{ data: ap, backgroundColor:'#f59e0b' }] },
                options:{ maintainAspectRatio:false,
                    plugins:{legend:{display:false}, tooltip:{callbacks:{label:c=>peso(c.parsed.y)}}},
                    scales:{ y:{ beginAtZero:true, ticks:{ callback:v=>'₱'+Number(v).toLocaleString() } } }
                }
            });
        }

        if ($('cashflowChart')) {
            new Chart($('cashflowChart'), {
                type:'line',
                data:{ labels: months, datasets:[
                    { label:'Collections (₱)', data: inflow,  borderColor:'#16a34a', tension:.3, fill:false },
                    { label:'Expenses (₱)',   data: outflow, borderColor:'#ef4444', tension:.3, fill:false }
                ]},
                options:{ maintainAspectRatio:false,
                    plugins:{ tooltip:{ callbacks:{ label:c=>peso(c.parsed.y) } } },
                    scales:{ y:{ beginAtZero:true, ticks:{ callback:v=>'₱'+Number(v).toLocaleString() } } }
                }
            });
        }

        if ($('topCustomersChart')) {
            const tLabels = (top||[]).map(t=>t.name);
            const tValues = (top||[]).map(t=>t.sum);
            new Chart($('topCustomersChart'), {
                type:'doughnut',
                data:{ labels:tLabels, datasets:[{ data:tValues, backgroundColor:['#22c55e','#3b82f6','#a855f7','#f97316','#e11d48'] }] },
                options:{ maintainAspectRatio:false, plugins:{ legend:{ position:'bottom' } } }
            });
        }
    }
});
</script>
@endpush
