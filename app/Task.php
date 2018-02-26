<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function time()
    {
        return $this->hasMany(Time::class);
    }
}
