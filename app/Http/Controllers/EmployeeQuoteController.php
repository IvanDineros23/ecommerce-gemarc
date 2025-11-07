<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote;
use App\Models\Product;
use App\Models\Order;
use App\Helpers\AuditLogger;

class EmployeeQuoteController extends Controller
{
    /**
     * Quote Management main page:
     * - Manual Quotes (walang order, hindi cancelled)
     * - Pending Orders (walang quote)
     * - All Quotes (with search)
     * - Cancelled Quotes (bagong tab)
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        // 1) Manual quotes only (walang naka-link na order, HINDI cancelled)
        $manualQuotes = Quote::with(['user', 'items', 'order'])
            ->whereDoesntHave('order')
            ->where(function ($q) {
                // isama lahat maliban sa cancelled
                $q->whereNull('status')
                  ->orWhere('status', '!=', 'cancelled');
            })
            ->orderByDesc('created_at')
            ->get();

        // 2) All quotes (para sa All Quotes tab + search)
        $allQuotesQuery = Quote::with(['user', 'items', 'order'])
            ->orderByDesc('created_at');

        if ($search) {
            $allQuotesQuery->where(function ($q) use ($search) {
                $q->where('number', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $allQuotes = $allQuotesQuery->get();

        // 3) Orders that still need a quote
        $ordersNeedingQuote = Order::with('user')
            ->whereNull('quote_id')
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->get();

        // 4) Cancelled quotes (bagong tab)
        $cancelledQuotes = Quote::with(['user', 'items', 'order'])
            ->where('status', 'cancelled')
            ->orderByDesc('created_at')
            ->get();

        return view('dashboard.employee_quotes', [
            'manualQuotes'       => $manualQuotes,
            'allQuotes'          => $allQuotes,
            'ordersNeedingQuote' => $ordersNeedingQuote,
            'cancelledQuotes'    => $cancelledQuotes,
            'search'             => $search,
        ]);
    }

    /**
     * Send a quote to the customer (employee action).
     */
    public function sendToCustomer(Quote $quote)
    {
        $quote->status = 'sent';
        $quote->save();

        AuditLogger::log(Auth::id(), 'employee', 'send_quote_to_customer', [
            'quote_id' => $quote->id,
            'user_id'  => $quote->user_id,
            'status'   => $quote->status,
        ]);

        return redirect()
            ->route('employee.quotes.management.index')
            ->with('success', 'Quote sent to customer.');
    }

    /**
     * Customer approves the quote.
     */
    public function approve(Quote $quote)
    {
        $quote->status = 'approved';
        $quote->save();

        AuditLogger::log($quote->user_id, 'customer', 'approve_quote', [
            'quote_id' => $quote->id,
            'status'   => $quote->status,
        ]);

        return redirect()
            ->route('quotes.show', $quote->id)
            ->with('success', 'You have approved the quotation.');
    }

    /**
     * Customer declines the quote.
     */
    public function declineQuote(Quote $quote)
    {
        $quote->status = 'declined';
        $quote->save();

        AuditLogger::log($quote->user_id, 'customer', 'decline_quote', [
            'quote_id' => $quote->id,
            'status'   => $quote->status,
        ]);

        return redirect()
            ->route('quotes.show', $quote->id)
            ->with('success', 'You have declined the quotation.');
    }

    /**
     * Show the manual quote creation form page.
     */
    public function manualCreateForm()
    {
        return view('dashboard.employee_quote_manual_create');
    }

    /**
     * Store a manually created quote (all fields manual, including employee name).
     */
    public function manualCreate(Request $request)
    {
        $validated = $request->validate([
            'employee_name'      => 'required|string|max:255',
            'customer_name'      => 'required|string|max:255',
            'customer_email'     => 'required|email',
            'customer_address'   => 'required|string',
            'customer_contact'   => 'required|string',
            'items'              => 'required|array|min:1',
            'items.*.name'       => 'required|string',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $quote = Quote::create([
            'number'  => null,
            'status'  => 'open',
            'total'   => 0,
            'user_id' => Auth::id(),
        ]);

        $total = 0;
        foreach ($validated['items'] as $item) {
            $quote->items()->create([
                'product_id' => null,
                'name'       => $item['name'],
                'quantity'   => (int) $item['quantity'],
                'unit_price' => (float) $item['unit_price'],
            ]);

            $total += (int) $item['quantity'] * (float) $item['unit_price'];
        }

        $quote->total = $total;
        $quote->save();

        AuditLogger::log(Auth::id(), 'employee', 'manual_create_quote_details', [
            'quote_id'         => $quote->id,
            'employee_name'    => $validated['employee_name'],
            'customer_name'    => $validated['customer_name'],
            'customer_email'   => $validated['customer_email'],
            'customer_address' => $validated['customer_address'],
            'customer_contact' => $validated['customer_contact'],
        ]);

        return redirect()
            ->route('employee.quotes.management.index')
            ->with('success', 'Manual quote created successfully!');
    }

    /**
     * Show edit page for a quote.
     */
    public function edit(Quote $quote)
    {
        $quote->load(['user', 'items']);
        $products = Product::where('is_active', 1)->orderBy('name')->get();

        return view('dashboard.employee_quote_edit', compact('quote', 'products'));
    }

    /**
     * Update an existing quote and its items.
     */
    public function update(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'customer_name'      => 'required|string|max:255',
            'customer_email'     => 'required|email',
            'customer_address'   => 'required|string',
            'customer_contact'   => 'required|string',
            'items'              => 'required|array|min:1',
            'items.*.name'       => 'required|string',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        if ($quote->user) {
            $quote->user->name       = $validated['customer_name'];
            $quote->user->email      = $validated['customer_email'];
            $quote->user->address    = $validated['customer_address'];
            $quote->user->contact_no = $validated['customer_contact'];
            $quote->user->save();
        }

        $quote->items()->delete();

        $total = 0;
        foreach ($validated['items'] as $item) {
            $quote->items()->create([
                'product_id' => null,
                'name'       => $item['name'],
                'quantity'   => (int) $item['quantity'],
                'unit_price' => (float) $item['unit_price'],
            ]);

            $total += (int) $item['quantity'] * (float) $item['unit_price'];
        }

        $quote->total = $total;
        $quote->save();

        AuditLogger::log(Auth::id(), 'employee', 'update_quote', [
            'quote_id' => $quote->id,
            'total'    => $quote->total,
            'items'    => count($validated['items']),
        ]);

        return redirect()
            ->route('employee.quotes.management.index')
            ->with('success', 'Quotation updated successfully!');
    }

    /**
     * Create a new quote (manual/checklist modes).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email',
            'customer_address' => 'required|string',
            'customer_contact' => 'required|string',
            'item_mode'        => 'required|in:manual,checklist',
            'manual_items'     => 'nullable|string',
            'product_ids'      => 'nullable|array',
            'product_ids.*'    => 'integer',
        ]);

        $quote = Quote::create([
            'status'  => 'open',
            'user_id' => Auth::id(),
            'total'   => 0,
        ]);

        $total = 0;

        if ($validated['item_mode'] === 'manual' && !empty($validated['manual_items'])) {
            $lines = preg_split('/\r?\n/', $validated['manual_items']);
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line !== '') {
                    $quote->items()->create([
                        'product_id' => null,
                        'name'       => $line,
                        'quantity'   => 1,
                        'unit_price' => 0,
                    ]);
                }
            }
        } elseif ($validated['item_mode'] === 'checklist' && !empty($validated['product_ids'])) {
            $products = Product::whereIn('id', $validated['product_ids'])->get();
            foreach ($products as $product) {
                $quote->items()->create([
                    'product_id' => $product->id,
                    'name'       => $product->name,
                    'quantity'   => 1,
                    'unit_price' => $product->price ?? 0,
                ]);

                $total += (float) ($product->price ?? 0);
            }
        }

        if ($total > 0) {
            $quote->total = $total;
            $quote->save();
        }

        AuditLogger::log(Auth::id(), 'employee', 'create_quote', [
            'quote_id' => $quote->id,
            'mode'     => $validated['item_mode'],
            'total'    => $quote->total,
        ]);

        return redirect()
            ->route('employee.quotes.management.index')
            ->with('success', 'Quotation created successfully!');
    }

    /**
     * Mark quote as done.
     */
    public function markAsDone(Quote $quote)
    {
        $quote->status = 'done';
        $quote->save();

        AuditLogger::log(Auth::id(), 'employee', 'mark_quote_done', [
            'quote_id' => $quote->id,
            'user_id'  => $quote->user_id,
            'status'   => $quote->status,
        ]);

        return redirect()
            ->route('employee.quotes.management.index')
            ->with('success', 'Quote marked as done.');
    }

    /**
     * Cancel a quote.
     */
    public function cancel(Quote $quote)
    {
        $quote->status = 'cancelled';
        $quote->save();

        AuditLogger::log(Auth::id(), 'employee', 'cancel_quote', [
            'quote_id' => $quote->id,
            'user_id'  => $quote->user_id,
            'status'   => $quote->status,
        ]);

        return redirect()
            ->route('employee.quotes.management.index')
            ->with('success', 'Quote cancelled.');
    }

    /**
     * Upload PDF response for a quote.
     */
    public function upload(Request $request, Quote $quote)
    {
        $request->validate([
            'quote_file' => 'required|file|mimes:pdf|max:5120',
        ]);

        $path = $request->file('quote_file')->store('quotes', 'public');
        $quote->response_file = $path;
        $quote->save();

        AuditLogger::log(Auth::id(), 'employee', 'upload_quote_pdf', [
            'quote_id' => $quote->id,
            'file'     => $path,
        ]);

        return back()->with('success', 'PDF quotation uploaded successfully!');
    }

    /**
     * Delete a quote.
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();

        AuditLogger::log(Auth::id(), 'employee', 'delete_quote', [
            'quote_id' => $quote->id,
            'user_id'  => $quote->user_id,
        ]);

        return redirect()
            ->route('employee.quotes.management.index')
            ->with('success', 'Quote deleted successfully.');
    }

    /**
     * Show all orders for quote management (tabbed view: pending/cancelled).
     */
    public function allOrders(Request $request)
    {
        $status = $request->get('status', 'pending');

        $orders = Order::with('user', 'quote')
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->orderByDesc('created_at')
            ->get();

        return view('dashboard.employee_quotes_all_orders', compact('orders', 'status'));
    }

    /**
     * Create a new quote from an order.
     */
    public function createFromOrder(Order $order)
    {
        if ($order->quote_id) {
            return redirect()
                ->route('employee.quotes.management.index')
                ->with('error', 'This order already has a quotation.');
        }

        $quote = Quote::create([
            'number'  => null,
            'status'  => 'open',
            'total'   => 0,
            'user_id' => $order->user_id,
        ]);

        $order->quote_id = $quote->id;
        $order->save();

        $total = 0;

        foreach ($order->items as $orderItem) {
            $quote->items()->create([
                'product_id' => $orderItem->product_id ?? null,
                'name'       => $orderItem->name ?? ($orderItem->product->name ?? 'Item'),
                'quantity'   => (int) $orderItem->quantity,
                'unit_price' => (float) $orderItem->unit_price,
            ]);

            $total += (int) $orderItem->quantity * (float) $orderItem->unit_price;
        }

        $quote->total = $total;
        $quote->save();

        AuditLogger::log(Auth::id(), 'employee', 'create_quote_from_order', [
            'order_id' => $order->id,
            'quote_id' => $quote->id,
            'total'    => $total,
        ]);

        return redirect()
            ->route('employee.quotes.management.index')
            ->with('success', 'Quotation created from order successfully.');
    }

    /**
     * Cancel a pending order from the Quote Management Pending Quotes tab.
     */
    public function cancelOrder(Order $order)
    {
        if ($order->status === 'cancelled') {
            return back()->with('info', 'This order is already cancelled.');
        }

        $oldStatus      = $order->status;
        $order->status  = 'cancelled';
        $order->save();

        AuditLogger::log(Auth::id(), 'employee', 'cancel_order_from_quote_management', [
            'order_id'   => $order->id,
            'old_status' => $oldStatus,
            'status'     => $order->status,
        ]);

        return back()->with('success', 'Order cancelled successfully.');
    }
}
