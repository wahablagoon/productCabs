<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeakHourPricing extends Model
{
    protected $table = 'peak_hour_pricing';
    protected $fillable = ['start_time','end_time','days','amount','type','category'];
}