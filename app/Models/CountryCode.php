<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryCode extends Model
{
    protected $table = 'country';
    protected $fillable = ['name','iso','isd'];
}
