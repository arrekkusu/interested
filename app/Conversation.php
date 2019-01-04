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
       return $this->hasOne(Interest::class, 'id', 'interest_id');
    }
    public function message()
    {
       return $this->hasMany(Message::class);
    }
}
