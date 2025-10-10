<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'audit_logs';
    protected $fillable = [
        'actor_user_id', 'action', 'entity', 'entity_id', 'before_json', 'after_json', 'details',
    ];
    
    // Fix for potential database column name mismatch
    public function setBeforeDataAttribute($value)
    {
        $this->attributes['before_json'] = $value;
    }
    
    public function setAfterDataAttribute($value)
    {
        $this->attributes['after_json'] = $value;
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_user_id');
    }
}
