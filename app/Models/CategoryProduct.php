<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    //* Pivot table must be declared
    protected $table = 'category_product';
}
