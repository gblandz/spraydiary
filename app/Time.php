<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
	public $timestamps = false;
    public function task()
    {
    	return $this->belongsTo(Task::class);
	}

	public function block()
	{
		return $this->belongsTo(Block::class);
	}
}


