<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'audit_logs';
    protected $fillable = [
        'actor_user_id', 'action', 'entity', 'entity_id', 'before_json', 'after_json', 'details',
    ];

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_user_id');
    }
}
