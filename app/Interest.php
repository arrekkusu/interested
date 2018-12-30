<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [
        'title', 'description', 'interest_url'
    ];
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function conversation()
    {
        return $this->hasMany(Conversation::class);
    }
}
