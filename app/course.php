<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
	protected $primaryKey = "cid";

	public function Dept(){
		return $this->hasOne('App\dept','did','did');
	}

	public function Lecturer(){
		return $this->hasOne('App\lecturer','lid','lid');
	}
}
