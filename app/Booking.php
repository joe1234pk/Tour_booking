<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    public $timestamps = false;
    protected $guarded=[''];

    public function tour()
    {
    return $this->belongsTo('App\Tour');

    }

    public function passengers(){

    	return $this->belongsToMany('App\Passenger')->withPivot('special_request')->withTimestamps();
    }
}
