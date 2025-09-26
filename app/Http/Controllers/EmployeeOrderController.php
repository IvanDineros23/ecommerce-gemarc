<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class EmployeeOrderController extends Controller
{
    public function index()
    {
        // Fetch all orders with user info
        $orders = Order::with('user')->orderByDesc('created_at')->get();
        $notifications = [];
        return view('dashboard.employee_orders', compact('orders', 'notifications'));
    }
}
