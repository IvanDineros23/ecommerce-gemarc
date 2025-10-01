<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use App\Helpers\AuditLogger;

class ProductController extends Controller
{
    /** List all products. */
    public function index()
    {
        $products = Product::orderByDesc('created_at')->get();
        return view('admin.placeholders.products', compact('products'));
    }

    /** Show edit form. */
    public function edit(Product $product)
    {
        return view('admin.placeholders.edit_product', compact('product'));
    }

    /** Store new product. */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'unit_price'  => 'required|numeric|min:0',
            'stock_qty'   => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048',
            'sku'         => 'nullable|string|max:100',
            'is_active'   => 'nullable|boolean',
        ]);

        $slug = $this->makeUniqueSlug($data['name']);

        DB::beginTransaction();
        try {
            $product = Product::create([
                'name'        => $data['name'],
                'description' => $data['description'],
                'unit_price'  => $data['unit_price'],
                'stock'       => $data['stock_qty'],
                'slug'        => $slug,
                'sku'         => $data['sku'] ?? null,
                'is_active'   => (bool)($data['is_active'] ?? true),
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
            AuditLogger::log('create', 'product', $product->id, null, $product->toArray());

            DB::commit();

            return redirect()
                ->route('admin.products')
                ->with('success', 'Product added!')
                ->with('added_product_name', $product->name);

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors('Failed to add product. Please try again.')->withInput();
        }
    }

    /** Update product. */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'unit_price'  => 'required|numeric|min:0',
            'stock_qty'   => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048',
            'sku'         => 'nullable|string|max:100',
            'is_active'   => 'nullable|boolean',
        ]);

        $slug = $product->name === $data['name']
            ? $product->slug
            : $this->makeUniqueSlug($data['name'], $product->id);

        DB::beginTransaction();
        try {
            $before = $product->toArray();

            $product->update([
                'name'        => $data['name'],
                'description' => $data['description'],
                'unit_price'  => $data['unit_price'],
                'stock'       => $data['stock_qty'],
                'slug'        => $slug,
                'sku'         => $data['sku'] ?? null,
                'is_active'   => (bool)($data['is_active'] ?? $product->is_active),
            ]);

            if ($request->hasFile('image')) {
                // delete old files + rows
                foreach ($product->images as $img) {
                    if ($img->path && Storage::disk('public')->exists($img->path)) {
                        Storage::disk('public')->delete($img->path);
                    }
                }
                $product->images()->delete();

                // store new
                $path = $request->file('image')->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path'       => $path,
                    'sort_order' => 0,
                ]);
            }

            // Audit log
            $user = auth()->user();
            $role = method_exists($user, 'isAdmin') && $user->isAdmin() ? 'admin' : (method_exists($user, 'isEmployee') && $user->isEmployee() ? 'employee' : 'user');
            $oldStock = $before['stock'] ?? null;
            $newStock = $product->stock;
            $details = ($oldStock !== $newStock)
                ? "{$role} '{$user->name}' (ID: {$user->id}) updated stock for product '{$product->name}' (ID: {$product->id}) from {$oldStock} to {$newStock}."
                : "{$role} '{$user->name}' (ID: {$user->id}) updated product '{$product->name}' (ID: {$product->id}).";
            AuditLogger::log('update', $role, $product->id, $before, $product->toArray(), $details);

            DB::commit();

            return redirect()->route('admin.products')->with('success', 'Product updated!');

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors('Failed to update product.')->withInput();
        }
    }

    /** Delete product (+ images). */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            $before = $product->toArray();

            foreach ($product->images as $img) {
                if ($img->path && Storage::disk('public')->exists($img->path)) {
                    Storage::disk('public')->delete($img->path);
                }
            }
            $product->images()->delete();
            $product->delete();

            // Audit log
            AuditLogger::log('delete', 'product', $product->id, $before, null);

            DB::commit();
            return redirect()->route('admin.products')->with('success', 'Product deleted!');

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors('Failed to delete product.');
        }
    }

    /** Ensure unique slug. */
    private function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;

        while (
            Product::when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
