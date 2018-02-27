<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['id', 'block_name'];
    public $timestamps = false;


    public function getUpdatedAtColumn() {
    return null;
	}
}
