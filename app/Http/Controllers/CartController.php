<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
            'checked_out_at' => null,
        ]);

    $items = $cart->items()->with('product:id,name,unit_price')->get();
    $total = $items->sum(fn (CartItem $i) => ($i->unit_price ?? optional($i->product)->unit_price ?? 0) * $i->qty);

        return view('cart.index', compact('cart', 'items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'nullable|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
            'checked_out_at' => null,
        ]);

        $product = Product::findOrFail($request->product_id);

        $item = $cart->items()->firstOrNew(['product_id' => $request->product_id]);
        $item->qty        = ($item->qty ?? 0) + ($request->quantity ?? 1);
        $item->unit_price = $product->unit_price;
        $item->user_id    = Auth::id();
        $item->save();

        return redirect()->route('cart.index')->with('status', 'Added to cart.');
    }

    public function update(Request $request)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
            'checked_out_at' => null,
        ]);

        // Update quantities
        foreach ($request->input('quantities', []) as $itemId => $qty) {
            $item = $cart->items()->find($itemId);
            if ($item && (int)$qty > 0) {
                $item->qty = (int)$qty;
                $item->save();
            }
        }

        // Update specifications
        foreach ($request->input('specifications', []) as $itemId => $specifications) {
            $item = $cart->items()->find($itemId);
            if ($item) {
                $item->specifications = $specifications;
                $item->save();
            }
        }

        return redirect()->route('cart.index')->with('status', 'Cart and specifications updated successfully.');
    }

    // GET /cart/checkout
    public function checkout(Request $request)
    {
        $user = $request->user();

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
            'checked_out_at' => null,
        ]);

    $items = $cart->items()->with('product:id,name,unit_price')->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'Your cart is empty.');
        }

        $subtotal = $items->sum(function (CartItem $i) {
            $unit = $i->unit_price ?? optional($i->product)->unit_price ?? 0;
            return $unit * $i->qty;
        });
        $shipping = 0;
        $tax      = 0;
        $total    = $subtotal + $shipping + $tax;

        // para tugma sa view mo na gumagamit ng $cartItems/$total
        $cartItems = $items;

        return view('cart.checkout', compact('cart', 'items', 'cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    // POST /cart/checkout
    public function processCheckout(Request $request)
    {
        $user = $request->user();

        // Validate quantities and specifications from cart
        $data = $request->validate([
            'quantities.*' => 'nullable|integer|min:1',
            'specifications.*' => 'nullable|string|max:2000',
            'ship_to_name'    => 'nullable|string|max:120',
            'ship_to_address' => 'nullable|string|max:255',
            'notes'           => 'nullable|string|max:1000',
            'payment_method'  => 'nullable|string|max:32',
            'delivery_method' => 'nullable|string|max:32',
        ]);

        $cart = Cart::where('user_id', $user->id)->whereNull('checked_out_at')->firstOrFail();
        $items = $cart->items()->with('product:id,name,unit_price')->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'Your cart is empty.');
        }

        // First update cart quantities and specifications if provided
        if (isset($data['quantities']) || isset($data['specifications'])) {
            foreach ($items as $item) {
                $updated = false;
                
                // Update quantity if provided
                if (isset($data['quantities'][$item->id])) {
                    $item->qty = max(1, (int)$data['quantities'][$item->id]);
                    $updated = true;
                }
                
                // Update specifications if provided
                if (isset($data['specifications'][$item->id])) {
                    $item->specifications = $data['specifications'][$item->id];
                    $updated = true;
                }
                
                if ($updated) {
                    $item->save();
                }
            }
        }

        // Recalculate totals with updated quantities
        $subtotal = $items->sum(function (CartItem $i) {
            $unit = $i->unit_price ?? optional($i->product)->unit_price ?? 0;
            return $unit * $i->qty;
        });
        $shipping = 0;
        $tax      = 0;
        $total    = $subtotal + $shipping + $tax;

        DB::transaction(function () use ($user, $cart, $items, $data, $subtotal, $shipping, $tax, $total) {
            $reference = 'GEI-'.now()->format('Ymd').'-'.strtoupper(substr(uniqid(), -4));

            $order = Order::create([
                'user_id'          => $user->id,
                'reference_number' => $reference,
                'status'           => 'pending',
                'subtotal_amount'  => $subtotal,
                'shipping_amount'  => $shipping,
                'tax_amount'       => $tax,
                'total_amount'     => $total,
                'ship_to_name'     => $data['ship_to_name'] ?? $user->name,
                'ship_to_address'  => $data['ship_to_address'] ?? $user->address,
                'notes'            => $data['notes'] ?? 'Order submitted from cart with specifications',
                'payment_method'   => $data['payment_method'] ?? 'pending_quote',
                'delivery_method'  => $data['delivery_method'] ?? 'standard',
            ]);

            foreach ($items as $i) {
                $unit = $i->unit_price ?? optional($i->product)->unit_price ?? 0;
                OrderItem::create([
                    'order_id'       => $order->id,
                    'product_id'     => $i->product_id,
                    'name'           => optional($i->product)->name,
                    'quantity'       => $i->qty,
                    'unit_price'     => $unit,
                    'line_total'     => $unit * $i->qty,
                    'specifications' => $i->specifications, // Include specifications
                ]);
            }

            // Push employee notification for new order
            \App\Helpers\EmployeeNotification::push('order', [
                'user' => $user->name,
                'user_id' => $user->id,
                'order_id' => $order->id,
                'reference' => $order->reference_number,
                'total' => $order->total_amount,
                'created_at' => now(),
            ]);

            $cart->items()->delete(); // Remove all items from cart after checkout
            $cart->update(['checked_out_at' => now()]);
        });

        // Redirect to orders page with success message
        return redirect()->route('orders.index')->with('success', 'Order submitted successfully! Your specifications have been included for review by our sales team.');
    }

    // GET /orders/{order}/receipt
    public function orderReceipt(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $orderItems = $order->items()->with('product')->get();
        $total = $order->total_amount;

        return view('orders.receipt', compact('order', 'orderItems', 'total'));
    }
}
