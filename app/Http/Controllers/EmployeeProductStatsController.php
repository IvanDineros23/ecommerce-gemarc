<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class EmployeeProductStatsController extends Controller
{
    /**
     * Return product stock counts for dashboard (with search)
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $query = Product::query();
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        $products = $query->orderBy('name')->get(['id', 'name', 'stock']);
        if ($request->wantsJson()) {
            return response()->json($products);
        }
        return view('dashboard.employee_product_stats', compact('products', 'search'));
    }
}
