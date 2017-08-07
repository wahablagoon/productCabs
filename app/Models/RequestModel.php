<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $table = 'request';
    protected $fillable = ['pickup','destination','payment_mode','passenger_id','driver_id','category','pickup_address','drop_address','request_type','trip_id','ride_type','request_status','eta','status','c_id'];
}
