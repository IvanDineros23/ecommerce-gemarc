<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Quote;

use App\Helpers\AuditLogger;

class QuoteController extends Controller
{
    // User: list all quotes (actual)
    public function userQuotes()
    {
        $user = auth()->user();
        $quotes = Quote::where('user_id', $user->id)->orderByDesc('created_at')->get();
        return view('dashboard.user_quotes', compact('quotes'));
    }
    // Show create quote form
    public function create(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('is_active', 1)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                      ->orWhere('description', 'like', "%$search%")
                      ->orWhere('sku', 'like', "%$search%")
                      ->orWhere('id', $search);
                });
            })
            ->with('images')
            ->paginate(10);
        return view('quotes.create', compact('products', 'search'));
    }

    // Store quote and generate PDF (stub)
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'notes' => 'nullable|string',
        ]);

    $user = auth()->user();
    $quote = new \App\Models\Quote();
    $quote->user_id = $user->id;
    $quote->status = 'open';
    $quote->total = 0; // will compute below
    // Generate quote number: GEI-GDS-YYYY-XXXX
    $year = date('Y');
    $random = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
    $quote->number = 'GEI-GDS-' . $year . '-' . $random;
    $quote->reference_number = $quote->number;
    $quote->save();

        $total = 0;
        foreach ($request->products as $productId) {
            $qty = (int)($request->quantities[$productId] ?? 1);
            $product = \App\Models\Product::find($productId);
            $item = new \App\Models\QuoteItem();
            $item->quote_id = $quote->id;
            $item->product_id = $product->id;
            $item->name = $product->name;
            $item->quantity = $qty;
            $item->unit_price = $product->unit_price;
            $item->save();
            $total += $product->unit_price * $qty;
        }
        $quote->total = $total;
        // Also persist subtotal and VAT for consistency
        $quote->subtotal = $total;
        $quote->vat = $total * 0.12;
        $quote->total = $quote->subtotal + $quote->vat;
        $quote->save();

        // Audit log: user created quote
        $user = auth()->user();
        // Audit log: user created quote (detailed)
        $productDetails = [];
        foreach ($request->products as $productId) {
            $product = \App\Models\Product::find($productId);
            $qty = (int)($request->quantities[$productId] ?? 1);
            $productDetails[] = $product ? ($product->name . ' (ID: ' . $product->id . ', Qty: ' . $qty . ')') : ('ID: ' . $productId . ', Qty: ' . $qty);
        }
        $details = "User '{$user->name}' (ID: {$user->id}) submitted a quote request for: " . implode(', ', $productDetails) . ". Total: ₱" . number_format($quote->total, 2);
        AuditLogger::log('submit_quote', 'quote', $quote->id, null, null, $details);

        // Push employee notification for new quote
        \App\Helpers\EmployeeNotification::push('quote', [
            'user' => $user->name,
            'user_id' => $user->id,
            'quote_id' => $quote->id,
            'products' => $productDetails,
            'total' => $quote->total,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Quote request submitted!');
    }

    // Download/preview PDF
    public function pdf($quoteId)
    {
        $quote = \App\Models\Quote::with('items')->findOrFail($quoteId);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('quotes.pdf', compact('quote'));
        return $pdf->stream('quotation-' . ($quote->number ?? $quote->id) . '.pdf');
    }

    // Employee: list all quotes (actual)
    public function employeeIndex()
    {
        $search = request()->input('search', ''); // Initialize search variable

        $quotes = \App\Models\Quote::with('user')->latest()->get();
        $cancelledQuotes = \App\Models\Quote::with('user')->where('status', 'cancelled')->latest()->get();
        $manualQuotes = \App\Models\Quote::with('user')->where('status', '!=', 'cancelled')->latest()->get();
            // Orders from the ecommerce site that require a quotation.
            // We select orders where payment_method is 'pending_quote' and order status is still 'pending'.
            $ordersNeedingQuote = \App\Models\Order::with('user')->where('payment_method', 'pending_quote')->where('status', 'pending')->latest()->get();
        
        // Define all quotes and include pending orders so they appear in "All Quotes"
        $quoteModels = \App\Models\Quote::with(['user','items','order'])->orderByDesc('created_at')->get();
        $allQuotes = $quoteModels->map(function ($q) {
            $q->is_order = false;
            return $q;
        })->values()->toBase();

        $pendingOrdersForAll = \App\Models\Order::with(['user','items'])
            ->whereNull('quote_id')
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($order) {
                $obj = new \stdClass();
                $obj->is_order = true;
                $obj->order = $order;
                $obj->id = null;
                $obj->number = $order->reference_number;
                $obj->user = $order->user;
                $obj->created_at = $order->created_at;
                $obj->status = $order->status;
                $obj->items = $order->items->map(function ($it) {
                    $itm = new \stdClass();
                    $itm->name = $it->name ?? optional($it->product)->name ?? 'Item';
                    $itm->quantity = $it->quantity;
                    $itm->unit_price = $it->unit_price;
                    return $itm;
                });
                $obj->total = $order->total_amount;
                return $obj;
            })->toBase();

        $allQuotes = $allQuotes->merge($pendingOrdersForAll)->values();

        return view('dashboard.employee_quotes', compact('quotes', 'cancelledQuotes', 'manualQuotes', 'ordersNeedingQuote', 'search', 'allQuotes'));
    }

    // Employee: show a specific quote (stub)
    public function employeeShow($quoteId)
    {
        // Fetch and show quote details
        return 'Show quote #' . $quoteId . ' for employee (stub)';
    }

    // Update notes for a specific quote
    public function updateNotes(Request $request, $quoteId)
    {
        $request->validate([
            'notes' => 'nullable|string',
        ]);

        $quote = Quote::findOrFail($quoteId);
        $quote->notes = $request->input('notes');
        $quote->save();

        return back()->with('success', 'Notes updated successfully!');
    }

    // Fetch paginated quote items for live search
    public function getQuoteItems(Request $request)
    {
        $search = $request->input('search', '');

        $items = Product::where('name', 'LIKE', "%$search%")
            ->orderBy('name')
            ->paginate(12);

        return response()->json([
            'items' => $items->items(),
            'page' => $items->currentPage(),
            'has_prev' => $items->currentPage() > 1,
            'has_next' => $items->hasMorePages()
        ]);
    }
}
