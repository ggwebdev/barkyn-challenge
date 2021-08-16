<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'base_price',
        'total_price',
        'weight',
        'protein',
        'last_order_date',
        'next_order_date',
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'customer_id',
    ];

    public function customer(){

    	return $this->belongsTo(Customer::class);
        
    }

    public function pets(){

    	return $this->hasMany(Pet::class);
        
    }
    
}
