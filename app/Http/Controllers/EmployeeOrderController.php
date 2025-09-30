<?php

namespace App\Http\Controllers;

use App\Models\Order;

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
        $order->delete();

        // Or change to a named route if you have one:
        // return redirect()->route('employee.orders.index')->with('success', 'Order deleted successfully.');
        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
}
