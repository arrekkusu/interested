<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'body', 'conversation_id', 'user_id'
    ];
    public function conversation() {
        return $this->belongsToOne(Conversation::class);
    }
    public function user() {
        return $this->belongsToMany(User::class);
    }
}
