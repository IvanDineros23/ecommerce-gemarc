<?php

namespace App\Helpers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditLogger
{
    /**
     * Log an action to the audit_logs table.
     *
     * @param string $action
     * @param string|null $entity
     * @param int|null $entityId
     * @param array|null $before
     * @param array|null $after
     * @return void
     */
    /**
     * Log an action to the audit_logs table.
     *
     * @param string $action
     * @param string|null $entity
     * @param int|null $entityId
     * @param array|null $before
     * @param array|null $after
     * @param string|null $details Human-readable summary
     * @return void
     */
    public static function log($action, $entity = null, $entityId = null, $before = null, $after = null, $details = null)
    {
        AuditLog::create([
            'actor_user_id' => Auth::id(),
            'action'        => $action,
            'entity'        => $entity,
            'entity_id'     => $entityId,
            'before_json'   => $before ? json_encode($before) : null,
            'after_json'    => $after ? json_encode($after) : null,
            'details'       => $details,
        ]);
    }
}
