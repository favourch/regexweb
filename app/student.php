<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
	protected $primaryKey = "sid";

	public function Programme(){
		return $this->hasOne('App\program','progid','progid');
	}

	public function Results() {
		return $this->hasMany('App\result','sid','sid');
	}
}
