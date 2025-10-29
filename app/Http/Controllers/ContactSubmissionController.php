<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactSubmission;

class ContactSubmissionController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);
        $countryCode = $request->input('countryCode');
        $phone = $request->input('phone');
        $fullPhone = $countryCode ? ($countryCode . ' ' . $phone) : $phone;
        ContactSubmission::create([
            'full_name' => $request->input('fullname'),
            'email' => $request->input('email'),
            'phone' => $fullPhone,
            'company' => $request->input('company'),
            'service_interest' => $request->input('service'),
            'message' => $request->input('message'),
        ]);
        return redirect()->route('contact')->with('success', 'Your message has been sent!');
    }
}
