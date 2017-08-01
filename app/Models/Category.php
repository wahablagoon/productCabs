<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'car_category';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $fillable = ['category_name','price_km','price_minute','max_size','price_fare','logo','marker'];
}
