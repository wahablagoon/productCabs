<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $table = 'api';
    const CREATED_AT = 'created_by';
    const UPDATED_AT = 'modified_by';
    protected $fillable = ['api_name','code','value'];
}
