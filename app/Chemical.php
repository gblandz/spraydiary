<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Chemical extends Model
{	
	//public $timestamps = false;
	//protected $fillable = ['trade_name','components','rates','withhold_period','post_disease'];
    public function getAll() {
		$chemicals = DB::table('chemicals')->paginate(7);
		return $chemicals;
	}
	
	public function getId($id) {
		return $chemicals = DB::table('chemicals')->find($id);
	}
	
}
