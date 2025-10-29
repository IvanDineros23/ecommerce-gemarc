<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    protected $fillable = ['poll_id','option_id','user_id','ip_address'];

    public function option()
    {
        return $this->belongsTo(PollOption::class, 'option_id');
    }
}
