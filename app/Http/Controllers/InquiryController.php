<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
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
            return back()->withErrors($validator)->withInput();
        }

        $payload = $validator->validated();

        // Log to application log for visibility
        Log::info('Website Inquiry Received', [
            'name'     => $payload['name'] ?? null,
            'email'    => $payload['email'] ?? null,
            'phone'    => $payload['phone'] ?? null,
            'product'  => $payload['product'] ?? null,
            'category' => $payload['category'] ?? null,
        ]);

        // Optional: Push a lightweight employee notification if helper exists
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

        // TODO: You can wire up a Mailable here if SMTP is configured.
        // For now, we just flash success and return back.
        return back()->with('success', 'Thanks! Your inquiry has been sent. We\'ll get back to you soon.');
    }
}
