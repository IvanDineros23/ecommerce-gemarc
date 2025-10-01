<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Helpers\AuditLogger;
use Illuminate\Support\Facades\Auth;

class EmployeeOrderController extends Controller
{
    public function index()
    {
        // Fetch all orders with their user
        $orders = Order::with('user')->latest()->get();

        // If your view expects this:
        $notifications = [];

        return view('dashboard.employee_orders', compact('orders', 'notifications'));
    }

    public function destroy(Order $order)
    {
        $orderId = $order->id;
        $orderDetails = [
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'total' => $order->total ?? null,
        ];
        $order->delete();

        // Audit log: employee deleted order
        $employee = Auth::user();
        AuditLogger::log(
            $employee ? $employee->id : null,
            'employee',
            'delete_order',
            $orderDetails
        );
        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
}
