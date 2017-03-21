<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class lecturer extends Authenticatable
{

	protected $primaryKey = "lid";
	protected $guarded = ['lid'];

	protected $hidden = [
		'password',
	];

	public function Dept(){
		return  $this->hasOne('App\dept','did','did');
	}

}
