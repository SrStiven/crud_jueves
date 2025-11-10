<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function books()
    {
        return $this->hasMany(Books::class);
    }
}