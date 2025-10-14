<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
    $logs = AuditLog::orderByDesc('created_at')->paginate(10);
        return view('admin.audit.index', compact('logs'));
    }

    public function printAll()
    {
        $logs = AuditLog::with('actor')->latest()->get();
        $pdf = app('dompdf.wrapper')->loadView('admin.audit.print', compact('logs'));
        return $pdf->stream('audit-logs.pdf');
    }

    public function saveAll()
    {
        $logs = AuditLog::with('actor')->latest()->get();
        $pdf = app('dompdf.wrapper')->loadView('admin.audit.print', compact('logs'));
        return $pdf->download('audit-logs.pdf');
    }

    // Clear all audit logs
    public function clear(Request $request)
    {
        // Optionally, restrict to admin only
        // if (!$request->user() || $request->user()->role !== 'admin') {
        //     return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        // }
        AuditLog::truncate();
        return response()->json(['success' => true]);
    }
}
