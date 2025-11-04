<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tip;

class MarketingTipsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', \App\Http\Middleware\EnsureEmployee::class, \App\Http\Middleware\EnsureDepartment::class . ':marketing']);
    }

    public function index()
    {
        $tips = Tip::orderBy('sort_order')->paginate(4);
        return view('employee.marketing_tips', compact('tips'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'is_active' => 'nullable|boolean',
            ]);

            \DB::beginTransaction();

            $tip = Tip::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'is_active' => $request->has('is_active') ? (bool)$request->is_active : true,
            ]);

            \DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tip created successfully',
                    'tip' => $tip
                ]);
            }

            return back()->with('success', 'Tip created');

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Failed to create tip: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create tip'
                ], 500);
            }

            return back()->with('error', 'Failed to create tip')->withInput();
        }
    }

    public function update(Request $request, Tip $tip)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'is_active' => 'nullable|boolean',
            ]);

            \DB::beginTransaction();

            $tip->update([
                'title' => $data['title'],
                'content' => $data['content'],
                'is_active' => $request->has('is_active') ? (bool)$request->is_active : true
            ]);

            \DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tip updated successfully',
                    'tip' => $tip->fresh()
                ]);
            }

            return back()->with('success', 'Tip updated');

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Failed to update tip: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update tip'
                ], 500);
            }

            return back()->with('error', 'Failed to update tip')->withInput();
        }
    }

    public function destroy(Tip $tip)
    {
        try {
            \DB::beginTransaction();
            
            $tip->delete();
            
            \DB::commit();

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tip deleted successfully'
                ]);
            }

            return back()->with('success', 'Tip deleted');
            
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Failed to delete tip: ' . $e->getMessage());

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete tip'
                ], 500);
            }

            return back()->with('error', 'Failed to delete tip');
        }
    }
}