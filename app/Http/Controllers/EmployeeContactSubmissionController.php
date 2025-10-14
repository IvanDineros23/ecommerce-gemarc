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
}
