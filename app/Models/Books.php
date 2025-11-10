<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = ['name', 'title', 'count', 'gender', 'due_date', 'file_path', 'user_id'];

     public function logs()
    {
        return $this->hasMany(Log::class, 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
