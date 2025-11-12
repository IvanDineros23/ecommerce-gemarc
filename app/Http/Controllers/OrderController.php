<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Helpers\AuditLogger;

class OrderController extends Controller
{
    // GET /orders/{order}/json
    public function json(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $order->load('items');
        $items = $order->items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'quantity' => $item->quantity,
                'quote_status' => $item->quote_status ?? null,
            ];
        });
        return response()->json([
            'id' => $order->id,
            'reference_number' => $order->reference_number,
            'created_at' => $order->created_at->format('F d, Y h:i A'),
            'status' => $order->status,
            'payment_method' => $order->payment_method ?? 'N/A',
            'delivery_method' => $order->delivery_method ?? 'N/A',
            'remarks' => $order->remarks,
            'items' => $items,
        ]);
    }
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
        return view('orders.index', compact('orders'));
    }


    // POST /orders/{order}/cancel
    public function cancel(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if order is in pending state
        if ($order->status !== 'pending') {
            return response()->json(['error' => 'Only pending orders can be cancelled'], 400);
        }

        // Update order status to cancelled
        $order->update(['status' => 'cancelled']);

        // Audit log: user cancelled order
        $user = auth()->user();
        AuditLogger::log(
            $user ? $user->id : null,
            'user',
            'cancel_order',
            [
                'order_id' => $order->id,
                'total' => $order->total ?? null,
            ]
        );

        return response()->json(['success' => true]);
    }

    public function showJson(\App\Models\Order $order)
    {
        $this->authorize('view', $order); // optional but recommended
        $order->load(['items.product']);
        return response()->json([
            'id'              => $order->id,
            'reference_number'=> $order->reference_number,
            'created_at'      => $order->created_at->format('F d, Y h:i A'),
            'status'          => $order->status,
            'payment_method'  => $order->payment_method,
            'delivery_method' => $order->delivery_method,
            'remarks'         => $order->remarks,
            'items'           => $order->items->map(function ($i) {
                return [
                    'id'           => $i->id,
                    'name'         => $i->product->name ?? $i->name,
                    'quantity'     => (int) $i->quantity,
                    'quote_status' => $i->quote_status,
                ];
            }),
        ]);
    }
}
