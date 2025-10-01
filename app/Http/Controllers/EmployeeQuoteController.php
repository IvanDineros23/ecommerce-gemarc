<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\User;

use App\Helpers\AuditLogger;
use Illuminate\Support\Facades\Auth;

class EmployeeQuoteController extends Controller
{
    public function markAsDone(Quote $quote)
    {
        $quote->status = 'done';
        $quote->save();

        // Audit log: employee marked quote as done
        $employee = Auth::user();
        AuditLogger::log(
            $employee ? $employee->id : null,
            'employee',
            'mark_quote_done',
            [
                'quote_id' => $quote->id,
                'user_id' => $quote->user_id,
                'status' => $quote->status,
            ]
        );
        return redirect()->route('employee.quotes.management.index')->with('success', 'Quote marked as done.');
    }

    public function cancel(Quote $quote)
    {
        $quote->status = 'cancelled';
        $quote->save();

        // Audit log: employee cancelled quote
        $employee = Auth::user();
        AuditLogger::log(
            $employee ? $employee->id : null,
            'employee',
            'cancel_quote',
            [
                'quote_id' => $quote->id,
                'user_id' => $quote->user_id,
                'status' => $quote->status,
            ]
        );
        return redirect()->route('employee.quotes.management.index')->with('success', 'Quote cancelled.');
    }
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

        // Audit log: employee uploaded quote PDF
        $employee = Auth::user();
        AuditLogger::log(
            $employee ? $employee->id : null,
            'employee',
            'upload_quote_pdf',
            [
                'quote_id' => $quote->id,
                'user_id' => $quote->user_id,
                'file' => $path,
            ]
        );
        return back()->with('success', 'PDF quotation uploaded successfully!');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();

        // Audit log: employee deleted quote
        $employee = Auth::user();
        AuditLogger::log(
            $employee ? $employee->id : null,
            'employee',
            'delete_quote',
            [
                'quote_id' => $quote->id,
                'user_id' => $quote->user_id,
            ]
        );
        return redirect()->route('employee.quotes.management.index')->with('success', 'Quote deleted successfully.');
    }
}
