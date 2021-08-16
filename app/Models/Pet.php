<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subscription_id',
        'name',
        'gender',
        'photo',
        'breed',
        'birth_date',
        'lifestage',
        'activity',
        'body_type',
        'weight',
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'subscription_id',
    ];

    public function subscription(){

    	return $this->belongsTo(Subscription::class);
        
    }

    public function customer(){

    	return $this->hasOneThrough(Subscription::class, Customer::class);
        
    }
    
}
