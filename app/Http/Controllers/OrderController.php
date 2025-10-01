<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

use App\Helpers\AuditLogger;

class OrderController extends Controller
{
    // GET /orders
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
        return view('orders.index', compact('orders'));
    }

    // GET /orders/{order}
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        $order->load('items');

        // Audit log: user viewed order
        $user = auth()->user();
        AuditLogger::log(
            $user ? $user->id : null,
            'user',
            'view_order',
            [
                'order_id' => $order->id,
                'total' => $order->total ?? null,
            ]
        );
        return view('orders.show', compact('order'));
    }
}
