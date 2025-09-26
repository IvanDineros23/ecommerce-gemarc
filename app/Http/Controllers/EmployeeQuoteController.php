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
}
