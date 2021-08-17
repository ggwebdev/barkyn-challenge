<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Customer extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    const RULE_CUSTOMER = [
        'name'          => 'required',
        'birth_date'    => 'required|date|date_format:Y-m-d|before:-18 years',
        'gender'        => 'required|in:male,female',
        'email'         => 'required|email|unique:customers'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'birth_date',
        'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function subscription(){

    	return $this->hasOne(Subscription::class);
        
    }

    public function pets()
    {
        return $this->hasManyThrough(Pet::class, Subscription::class);
    }
}
