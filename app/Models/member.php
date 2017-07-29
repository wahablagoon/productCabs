<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    protected $table = 'member';
    const CREATED_AT = 'created_by';
    const UPDATED_AT = 'modified_by';
    protected $fillable = ['firstname','lastname','email','password','profile','phone','city','countrycode','role'];
}
