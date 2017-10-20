<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    //
    public $timestamps = false;
    protected $guarded=[''];


    public function bookings(){

    	return $this->belongsToMany('App\Passenger','booking_passenger');
    }
}
