<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
	public $timestamps = false;
    protected $guarded=[''];

    public function tour_dates(){

    	return $this->hasMany('App\TourDate');
    }
}
