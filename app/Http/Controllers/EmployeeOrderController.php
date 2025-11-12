<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product; // <-- ADD THIS
use App\Helpers\AuditLogger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EmployeeOrderController extends Controller
{
    public function storeManual(Request $request)
    {
        $validated = $request->validate([
            'customer_name'   => 'required|string|max:255',
            'order_items'     => 'nullable|string',
            'total_amount'    => 'required|numeric|min:0',
            'payment_method'  => 'nullable|string|max:255',
            'delivery_method' => 'nullable|string|max:255',
        ]);

        $order = new Order();
        $order->user_id         = null;
        $order->customer_name   = $validated['customer_name'];
        $order->order_items     = $validated['order_items'] ?? null;
        $order->total_amount    = $validated['total_amount'];
        $order->payment_method  = $validated['payment_method'] ?? null;
        $order->delivery_method = $validated['delivery_method'] ?? null;
        $order->status          = 'pending';
        $order->quote_id        = null;
        $order->save();

        AuditLogger::log('Created manual order', [
            'order_id'    => $order->id,
            'employee_id' => Auth::id(),
        ]);

        return redirect()
            ->route('employee.orders.index')
            ->with('success', 'Manual order created successfully!');
    }

    public function index()
{
    // Products for manual order modal
    $products = \App\Models\Product::orderBy('name', 'asc')->get();

    // ✅ Manual Orders:
    //  - quote_id is null  (manual)
    //  - may customer_name
    //  - status NOT IN (done, cancelled)
    $manualOrders = Order::with('user')
        ->whereNull('quote_id')
        ->whereNotNull('customer_name')
        ->whereNotIn('status', ['done', 'cancelled'])
        ->orderByDesc('created_at')
        ->get();

    // ✅ Pending Orders: lahat ng pending
    $pendingOrders = Order::with('user')
        ->where('status', 'pending')
        ->orderByDesc('created_at')
        ->get();

    // ✅ Done Orders: lahat ng done
    $doneOrders = Order::with('user')
        ->where('status', 'done')
        ->orderByDesc('created_at')
        ->get();

    // ✅ All Orders
    $allOrders = Order::with('user')
        ->orderByDesc('created_at')
        ->get();

    // ✅ Cancelled Orders
    $cancelledOrders = Order::with('user')
        ->where('status', 'cancelled')
        ->orderByDesc('created_at')
        ->get();

    $notifications = [];

    return view('dashboard.employee_orders', [
        'manualOrders'    => $manualOrders,
        'pendingOrders'   => $pendingOrders,
        'doneOrders'      => $doneOrders,
        'allOrders'       => $allOrders,
        'cancelledOrders' => $cancelledOrders,
        'notifications'   => $notifications,
        'products'        => $products,
    ]);
}

    public function markAsDone(Order $order)
    {
        $oldStatus = $order->status;

        $order->status = 'done';
        $order->save();

        $employee = Auth::user();
        AuditLogger::log(
            $employee ? $employee->id : null,
            'employee',
            'mark_order_done',
            [
                'order_id'   => $order->id,
                'old_status' => $oldStatus,
                'new_status' => 'done',
            ]
        );

        return redirect()
            ->back()
            ->with('success', 'Order marked as done.');
    }

    public function destroy(Order $order)
    {
        $orderDetails = [
            'order_id' => $order->id,
            'user_id'  => $order->user_id,
            'total'    => $order->total ?? null,
        ];

        $order->delete();

        $employee = Auth::user();
        AuditLogger::log(
            $employee ? $employee->id : null,
            'employee',
            'delete_order',
            $orderDetails
        );

        return redirect()
            ->back()
            ->with('success', 'Order deleted successfully.');
    }

    public function saveRemarks(Request $request, $orderId)
{
    $order = Order::findOrFail($orderId);
    $order->remarks = $request->input('remarks');
    $order->save();

    return response()->json(['message' => 'Remarks updated successfully.']);
}

public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids) && !empty($ids)) {
            Order::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'No orders selected.'], 400);
    }

    public function bulkDestroy(Request $request)
{
    $ids = $request->input('ids', []);

    if (empty($ids)) {
        return response()->json(['message' => 'No orders selected.'], 422);
    }

    \App\Models\Order::whereIn('id', $ids)->delete();

    return response()->json(['message' => 'Orders deleted successfully.']);
}
}

