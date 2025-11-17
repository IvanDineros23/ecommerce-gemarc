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
            ->get();
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
        $ordersNeedingQuote = \App\Models\Quote::with('user')->where('status', 'pending')->latest()->get();
        
        // Define all quotes
        $allQuotes = \App\Models\Quote::all();

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
}
