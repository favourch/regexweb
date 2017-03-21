<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dept extends Model
{
	protected $primaryKey = "did";

	public function Faculty(){
		return $this->belongsTo('App\faculty','fid','fid');
	}
}
