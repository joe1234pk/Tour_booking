<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourDate extends Model
{
    //
    public $timestamps = false;
    protected $table = 'tour_dates';
    protected $guarded =[''];
}
