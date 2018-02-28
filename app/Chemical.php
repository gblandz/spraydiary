<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chemical extends Model
{	
	public $timestamps = false;
	protected $fillable = ['id', 'chem_type', 'trade_name', 'components', 'rates', 'withhold_period', 'pest_disease'];
}
