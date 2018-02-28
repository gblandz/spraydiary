<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    public function task()
    {
    	return $this->belongsTo(Task::class);
	}
}


