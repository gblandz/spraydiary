<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shed extends Model
{
    protected $fillable = ['id', 'shed_name'];
    public $timestamps = false;

    public function getUpdatedAtColumn() {
    return null;
	}
}
