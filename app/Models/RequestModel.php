<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $table = 'request';
    const CREATED_AT = 'created_by';
    const UPDATED_AT = 'modified_by';
    protected $fillable = ['pickup','destination'];
}
