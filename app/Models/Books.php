<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = ['name', 'title', 'count', 'gender', 'due_date', 'file_path'];
}
