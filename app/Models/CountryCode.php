<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryCode extends Model
{
    protected $table = 'country_code';
    const CREATED_AT = 'created_by';
    const UPDATED_AT = 'modified_by';
    protected $fillable = ['name','iso','isd'];
}
