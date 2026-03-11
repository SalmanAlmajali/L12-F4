<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'sender_username',
        'receiver_username',
        'message',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];
    public function sender()
{
    return $this->belongsTo(User::class, 'sender_username', 'name');
}

public function receiver()
{
    return $this->belongsTo(User::class, 'receiver_username', 'name');
}
}
