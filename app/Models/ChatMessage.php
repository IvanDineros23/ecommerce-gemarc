<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];
        /**
         * Get the sender of the chat message.
         */
        public function sender()
        {
            return $this->belongsTo(User::class, 'sender_id');
        }
}
