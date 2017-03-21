<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class result extends Model
{
	protected $primaryKey = "resid";

	public function Student(){
		return $this->belongsTo('App\student','sid','sid');
	}

	public function Course() {
		return $this->belongsTo('App\course','cid','cid');
	}

	public function Lecturer(){
		return $this->belongsTo('App\lecturer','lid','lid');
	}
}
