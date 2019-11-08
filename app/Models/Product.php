<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function setPrice()
    {
        return '$' . number_format($this->price / 100, 2);
        // return money_format('$', $this->price / 100);
    }
}
