<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['title','question','is_active','sort_order'];

    public function options()
    {
        return $this->hasMany(PollOption::class)->orderBy('id');
    }
}
