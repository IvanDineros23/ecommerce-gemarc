<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogAjaxController extends Controller
{
    public function filter(Request $request)
    {
        $query = AuditLog::query();
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('details', 'like', "%$search%")
                  ->orWhere('entity', 'like', "%$search%")
                  ->orWhere('action', 'like', "%$search%")
                  ->orWhereHas('actor', function($q2) use ($search) {
                      $q2->where('name', 'like', "%$search%")
                         ->orWhere('email', 'like', "%$search%")
                         ->orWhere('role', 'like', "%$search%") ;
                  });
            });
        }
        $perPage = 12;
        $page = $request->input('page', 1);
        $logs = $query->orderByDesc('created_at')->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'logs' => $logs->getCollection()->map(function($log) {
                return [
                    'created_at' => $log->created_at->toDateTimeString(),
                    'user' => $log->actor ? $log->actor->name : 'N/A',
                    'user_id' => $log->actor ? $log->actor->id : null,
                    'role' => $log->actor ? $log->actor->role : 'N/A',
                    'action' => $log->action,
                    'details' => $log->details,
                ];
            }),
            'current_page' => $logs->currentPage(),
            'last_page' => $logs->lastPage(),
        ]);
    }
}
