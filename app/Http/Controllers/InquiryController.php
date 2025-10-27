<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    /**
     * Show all product inquiries to marketing employees.
     */
    public function index()
    {
        $inquiries = \App\Models\Inquiry::orderByDesc('created_at')->get();
        $contacts = \App\Models\ContactSubmission::orderByDesc('created_at')->get();
        return view('dashboard.employee_inquiries', compact('inquiries', 'contacts'));
    }
    /**
     * Handle public inquiry submissions from product/category pages.
     */
    public function submit(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'message' => ['nullable', 'string', 'max:5000'],
            'product' => ['nullable', 'string', 'max:255'],
            'category'=> ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Validation failed', 'messages' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $payload = $validator->validated();

        Log::info('Website Inquiry Received', [
            'name'     => $payload['name'] ?? null,
            'email'    => $payload['email'] ?? null,
            'phone'    => $payload['phone'] ?? null,
            'product'  => $payload['product'] ?? null,
            'category' => $payload['category'] ?? null,
        ]);

        \App\Models\Inquiry::create([
            'name'    => $payload['name'],
            'email'   => $payload['email'],
            'product' => $payload['product'] ?? '',
            'message' => $payload['message'] ?? '',
        ]);

        try {
            if (class_exists(\App\Helpers\EmployeeNotification::class)) {
                \App\Helpers\EmployeeNotification::push('inquiry', [
                    'title' => 'New Website Inquiry',
                    'from'  => $payload['name'] . ' <' . $payload['email'] . '>',
                    'product' => $payload['product'] ?? null,
                    'category'=> $payload['category'] ?? null,
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to push employee notification for inquiry', ['error' => $e->getMessage()]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => 'Thanks! Your inquiry has been sent. We\'ll get back to you soon.']);
        }
        return back()->with('success', 'Thanks! Your inquiry has been sent. We\'ll get back to you soon.');
    }
}
