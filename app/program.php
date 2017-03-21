<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class program extends Model
{
    protected $primaryKey = 'progid';

	public function Dept() {
		return $this->hasOne('App\dept','did','did');
	}
}
