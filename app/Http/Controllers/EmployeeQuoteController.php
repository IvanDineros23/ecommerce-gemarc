<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote;
use App\Models\Product;
use App\Helpers\AuditLogger;

class EmployeeQuoteController extends Controller
{
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
            'employee_name'    => 'required|string|max:255',
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email',
            'customer_address' => 'required|string',
            'customer_contact' => 'required|string',
            'items'            => 'required|array|min:1',
            'items.*.name'       => 'required|string',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $quote = new Quote();
        $quote->number = null;   // generate later if you have a mutator
        $quote->status = 'open';
        $quote->total  = 0;
        $quote->save();

        $total = 0;
        foreach ($validated['items'] as $item) {
            $quote->items()->create([
                'name'       => $item['name'],
                'quantity'   => (int) $item['quantity'],
                'unit_price' => (float) $item['unit_price'],
            ]);
            $total += (int)$item['quantity'] * (float)$item['unit_price'];
        }

        $quote->total = $total;
        $quote->save();

        AuditLogger::log(Auth::id(), 'employee', 'manual_create_quote', [
            'quote_id'      => $quote->id,
            'employee_name' => $validated['employee_name'],
            'items_count'   => count($validated['items']),
            'total'         => $total,
        ]);

        return redirect()->route('employee.quotes.management.index')
            ->with('success', 'Manual quote created successfully!');
    }

    /**
     * List quotes for employees (supports search/status/sort).
     */
    public function index(Request $request)
    {
        $query = Quote::with(['user', 'items'])->orderByDesc('created_at');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($request->get('sort') === 'asc') {
            $query->reorder('created_at', 'asc');
        }

        $quotes = $query->get();
        $notifications = [];

        return view('dashboard.employee_quotes', compact('quotes', 'notifications'));
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
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email',
            'customer_address' => 'required|string',
            'customer_contact' => 'required|string',
            'items'            => 'required|array|min:1',
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
                'name'       => $item['name'],
                'quantity'   => (int) $item['quantity'],
                'unit_price' => (float) $item['unit_price'],
            ]);
            $total += (int)$item['quantity'] * (float)$item['unit_price'];
        }

        $quote->total = $total;
        $quote->save();

        AuditLogger::log(Auth::id(), 'employee', 'update_quote', [
            'quote_id' => $quote->id,
            'total'    => $quote->total,
            'items'    => count($validated['items']),
        ]);

        return redirect()->route('employee.quotes.management.index')
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

        $quote = new Quote();
        $quote->status  = 'open';
        $quote->user_id = Auth::id();
        $quote->total   = 0;
        $quote->save();

        $total = 0;

        if ($validated['item_mode'] === 'manual' && !empty($validated['manual_items'])) {
            $lines = preg_split('/\r?\n/', $validated['manual_items']);
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line !== '') {
                    $quote->items()->create([
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
                    'name'       => $product->name,
                    'quantity'   => 1,
                    'unit_price' => $product->price ?? 0,
                ]);
                $total += (float)($product->price ?? 0);
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

        return redirect()->route('employee.quotes.management.index')
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

        return redirect()->route('employee.quotes.management.index')
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

        return redirect()->route('employee.quotes.management.index')
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

        return redirect()->route('employee.quotes.management.index')
            ->with('success', 'Quote deleted successfully.');
    }
}
