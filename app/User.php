<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable
{
    use Notifiable;

    use Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function interest()
    {
        return $this->belongsToMany(Interest::class);
    }
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function message()
    {
        return $this->BelongsToMany(Message::class);
    }
}
