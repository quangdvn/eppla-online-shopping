<?php

namespace App;

use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //* Created a new customer after a normal user is created
    //* by Eloquent Model
    protected static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            $user->customer()->create([
                'user_id' => $user->id
            ]);
        });
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
