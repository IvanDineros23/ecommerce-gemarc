<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    protected $fillable = ['title','question','is_active','sort_order'];

    public function options(): HasMany
    {
        return $this->hasMany(PollOption::class)->orderBy('id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(PollVote::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        // When deleting a poll, also delete related options and votes
        static::deleting(function ($poll) {
            $poll->votes()->delete();
            $poll->options()->delete();
        });
    }
}
