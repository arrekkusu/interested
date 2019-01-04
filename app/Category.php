<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function Interests()
    {
        return $this->belongsToMany(Interest::class);
    }
}
