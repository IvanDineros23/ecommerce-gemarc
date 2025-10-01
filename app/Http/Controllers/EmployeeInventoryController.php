<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class EmployeeInventoryController extends Controller
{
    public function index()
    {
    $products = Product::orderBy('name')->get();
    $notifications = [];
    return view('dashboard.employee_inventory', compact('products', 'notifications'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);
        $before = $product->toArray();
        $oldStock = $before['stock'] ?? null;
        $product->stock = $request->stock;
        $product->save();
        $employee = auth()->user();
        $role = method_exists($employee, 'isEmployee') && $employee->isEmployee() ? 'employee' : 'user';
        $newStock = $product->stock;
        $details = ($oldStock !== $newStock)
            ? "$role '{$employee->name}' (ID: {$employee->id}) updated stock for product '{$product->name}' (ID: {$product->id}) from {$oldStock} to {$newStock}."
            : "$role '{$employee->name}' (ID: {$employee->id}) updated product '{$product->name}' (ID: {$product->id}).";
        \App\Helpers\AuditLogger::log('update', $role, $product->id, $before, $product->toArray(), $details);
        return redirect()->route('employee.inventory.index')->with('success', 'Stock updated!');
    }
}
