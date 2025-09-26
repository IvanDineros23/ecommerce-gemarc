<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\User;

class EmployeeQuoteController extends Controller
{
    public function index()
    {
        // Fetch all quotes with user info
        $quotes = Quote::with('user')->orderByDesc('created_at')->get();
        $notifications = [];
        return view('dashboard.employee_quotes', compact('quotes', 'notifications'));
    }

    public function upload(Request $request, Quote $quote)
    {
        $request->validate([
            'quote_file' => 'required|file|mimes:pdf|max:5120', // max 5MB
        ]);
        $file = $request->file('quote_file');
        $path = $file->store('quotes', 'public');
        $quote->response_file = $path;
        $quote->save();
        return back()->with('success', 'PDF quotation uploaded successfully!');
    }
}
