<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class MarketingFaqController extends Controller
{
    public function __construct()
    {
    $this->middleware(['auth', 'verified', \App\Http\Middleware\EnsureEmployee::class, \App\Http\Middleware\EnsureDepartment::class . ':marketing']);
    }

    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->get();
        return view('employee.marketing_faqs', compact('faqs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->has('is_active') ? (bool)$request->is_active : true;
        $faq = Faq::create($data);
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'faq' => $faq]);
        }
        return back()->with('success', 'FAQ created');
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->has('is_active') ? (bool)$request->is_active : true;
        $faq->update($data);
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'faq' => $faq]);
        }
        return back()->with('success', 'FAQ updated');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'FAQ removed');
    }
}
