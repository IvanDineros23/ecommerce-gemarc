<?php
namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class EmployeeContactSubmissionController extends Controller
{
    public function index()
    {
        $submissions = ContactSubmission::orderByDesc('created_at')->get();
        return view('dashboard.employee_contact_submissions', compact('submissions'));
    }

    public function clear(Request $request)
    {
        ContactSubmission::truncate();
        return redirect()->route('employee.contact_submissions')->with('success', 'All contact submissions have been cleared.');
    }
}
