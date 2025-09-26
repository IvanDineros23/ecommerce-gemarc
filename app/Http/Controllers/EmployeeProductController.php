<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ProductImage;

class EmployeeProductController extends Controller
{
    public function index()
    {
    $products = Product::orderByDesc('created_at')->get();
    $notifications = [];
    return view('dashboard.employee_products', compact('products', 'notifications'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'unit_price' => 'required|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);
        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'unit_price' => $data['unit_price'],
            'stock_qty' => $data['stock_qty'],
            'slug' => Str::slug($data['name']) . '-' . uniqid(),
            'sku' => null,
            'is_active' => true,
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
                'sort_order' => 0,
            ]);
        }
        return redirect()->route('employee.products.index')
            ->with('success', 'Product added!')
            ->with('added_product_name', $product->name);
    }

    public function edit(Product $product)
    {
        $products = Product::orderByDesc('created_at')->get();
        return view('dashboard.employee_products', compact('products', 'product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'unit_price' => 'required|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);
        $product->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'unit_price' => $data['unit_price'],
            'stock_qty' => $data['stock_qty'],
        ]);
        if ($request->hasFile('image')) {
            // Remove old images
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->path);
                $img->delete();
            }
            $path = $request->file('image')->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
                'sort_order' => 0,
            ]);
        }
        // If no new image is uploaded, keep the old images (do nothing)
        return redirect()->route('employee.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }
        $product->delete();
        return redirect()->route('employee.products.index')->with('success', 'Product deleted!');
    }
}
