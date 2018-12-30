<?php

namespace App;

use App\Interest;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'title', 'participants', 'interest_id'
    ];
    public function interest()
    {
       return $this->belongsToOne(Interest::class);
    }
    public function message()
    {
       return $this->hasMany(Message::class);
    }
}
