<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use SearchableTrait;
    use Searchable;

    protected $fillable = ['seller_id'];

    /**
    * Searchable rules.
    *
    * @var array
    */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 10,
            'products.details' => 5,
            'products.description' => 2
        ]
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
        $extraFields = [
            'categories' => $this->categories->pluck('name')->toArray(),
        ];
        return array_merge($array, $extraFields);
    }

    public function setPrice()
    {
        return '$' . number_format($this->price / 100, 2);
    }

    public function scopeMightLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }
}
