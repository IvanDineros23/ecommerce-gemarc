<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\ProductImage;
use App\Helpers\AuditLogger;

class EmployeeProductController extends Controller
{
    /**
     * Return ALL products as JSON for client-side filtering (used by Alpine).
     */
    public function allProducts()
    {
        $products = Product::with('images')
            ->orderByDesc('created_at')
            ->get();

        $mapped = $products->map(function ($p) {
            $imagePath = method_exists($p, 'firstImagePath')
                ? $p->firstImagePath()
                : optional($p->images()->first())->path;

            return [
                'id'          => $p->id,
                'part_number' => $p->sku ?? '',
                'fo_number'   => $p->fo_number ?? '',
                'name'        => $p->name,
                'brand'       => $p->brand ?? '',
                'category'    => $p->category ?? '',
                'unit_price'  => $p->unit_price,
                'stock'       => $p->stock ?? 0,
                'description' => $p->description ?? '',
                'image_url'   => $imagePath ? asset('storage/' . ltrim($imagePath, '/')) : null,
                'update_url'  => route('employee.products.update', $p->id),
                'delete_url'  => route('employee.products.destroy', $p->id),
            ];
        });

        return response()->json($mapped);
    }

    /**
     * Show a single product (not really used now, pero retained).
     */
    public function show(Product $product)
    {
        $products = Product::orderByDesc('created_at')->get();
        return view('dashboard.employee_products', compact('products', 'product'));
    }

    /**
     * Main page – simple paginate for counts & footer.
     * Filtering is now PURELY client-side via allProducts().
     */
    public function index(Request $request)
    {
        $products = Product::orderByDesc('created_at')->paginate(6);
        $notifications = [];

        return view('dashboard.employee_products', compact('products', 'notifications'));
    }

    /**
     * Store a new product.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'unit_price'  => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        $product = Product::create([
              'name'        => $data['name'],
            'description' => $data['description'],
            'unit_price'  => $data['unit_price'],
            'stock'       => $data['stock'],
            'is_active'   => true,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path'       => $path,
                'sort_order' => 0,
            ]);
        }

        // Audit log
        $employee = Auth::user();
        $details = $employee
            ? "Created by {$employee->name} (ID: {$employee->id}) | Product: '{$product->name}', Price: ₱{$product->unit_price}, Quantity: {$product->stock}"
            : null;

        AuditLogger::log(
            'create',
            'employee_product',
            $product->id,
            null,
            [
                'name'       => $product->name,
                'unit_price' => $product->unit_price,
                'stock'      => $product->stock,
            ],
            $details
        );

        return redirect()
            ->route('employee.products.index')
            ->with('success', 'Product added!')
            ->with('added_product_name', $product->name);
    }

    /**
     * Show edit form (legacy).
     */
    public function edit(Product $product)
    {
        $products = Product::orderByDesc('created_at')->get();
        return view('dashboard.employee_products', compact('products', 'product'));
    }

    /**
     * Update a product.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'unit_price'  => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        $before = $product->toArray();

        $product->update([
             'name'        => $data['name'],
            'description' => $data['description'],
            'unit_price'  => $data['unit_price'],
            'stock'       => $data['stock'],
        ]);

        if ($request->hasFile('image')) {
            foreach ($product->images as $img) {
                if ($img->path) {
                    Storage::disk('public')->delete($img->path);
                }
                $img->delete();
            }

            $path = $request->file('image')->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path'       => $path,
                'sort_order' => 0,
            ]);
        }

        // Audit log
        $employee = Auth::user();
        $role     = (method_exists($employee, 'isEmployee') && $employee->isEmployee()) ? 'employee' : 'user';
        $oldStock = $before['stock'] ?? null;
        $newStock = $product->stock;

        $details = ($oldStock !== $newStock)
            ? "$role '{$employee->name}' (ID: {$employee->id}) updated stock for product '{$product->name}' (ID: {$product->id}) from {$oldStock} to {$newStock}."
            : "$role '{$employee->name}' (ID: {$employee->id}) updated product '{$product->name}' (ID: {$product->id}).";

        AuditLogger::log('update', 'employee_product', $product->id, $before, $product->toArray(), $details);

        return redirect()->route('employee.products.index')->with('success', 'Product updated!');
    }

    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        $before = $product->toArray();

        foreach ($product->images as $img) {
            if ($img->path) {
                Storage::disk('public')->delete($img->path);
            }
            $img->delete();
        }

        $product->delete();

        // Audit log
        $employee = Auth::user();
        $role     = (method_exists($employee, 'isEmployee') && $employee->isEmployee()) ? 'employee' : 'user';
        $details  = "$role '{$employee->name}' (ID: {$employee->id}) deleted product '{$product->name}' (ID: {$product->id}).";

        AuditLogger::log('delete', 'employee_product', $before['id'] ?? null, $before, null, $details);

        return redirect()->route('employee.products.index')->with('success', 'Product deleted!');
    }
}
