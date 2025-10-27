<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\ContactSubmission as Contact;

class EmployeeInquiryController extends Controller
{
    public function clearInquiries(Request $request)
    {
        $q = Inquiry::query();
        $filters = 0;
        if ($request->filled('name'))    { $q->where('name',    $request->name);    $filters++; }
        if ($request->filled('email'))   { $q->where('email',   $request->email);   $filters++; }
        if ($request->filled('product')) { $q->where('product', $request->product); $filters++; }
        if ($filters === 0) {
            return back()->with('error', 'Please select a Name, Email, or Product to clear.');
        }
        $count = (clone $q)->count();
        $q->delete();
        return back()->with('success', "Deleted {$count} product inquiry record(s).");
    }

    public function clearContacts(Request $request)
    {
        $q = Contact::query();
        $filters = 0;
        if ($request->filled('full_name'))        { $q->where('full_name',        $request->full_name);        $filters++; }
        if ($request->filled('email'))            { $q->where('email',            $request->email);            $filters++; }
        if ($request->filled('phone'))            { $q->where('phone',            $request->phone);            $filters++; }
        if ($request->filled('company'))          { $q->where('company',          $request->company);          $filters++; }
        if ($request->filled('service_interest')) { $q->where('service_interest', $request->service_interest); $filters++; }
        if ($filters === 0) {
            return back()->with('error', 'Please select a field to clear.');
        }
        $count = (clone $q)->count();
        $q->delete();
        return back()->with('success', "Deleted {$count} contact submission(s).");
    }
}
