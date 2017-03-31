<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class response extends Model
{
    public $table = "comments";

	public function Student(){
		return $this->belongsTo('App\student','sid','sid');
	}

	public function Course() {
		return $this->belongsTo('App\course','cid','cid');
	}
}
