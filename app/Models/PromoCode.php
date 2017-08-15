<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $table = 'promocode';
    protected $fillable = ['code','expired_in','type','amount','status'];
}
