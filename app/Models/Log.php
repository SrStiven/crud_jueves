<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['book_id', 'event_id', 'user'];

    public function book()
    {
        return $this->belongsTo(Books::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
