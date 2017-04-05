<?php

namespace App\Domain;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Courier extends Authenticatable
{
    
    const ACTIVATION_FALSE = 0;
    const ACTIVATION_TRUE = 1;

    public $incrementing = false;
    
    protected $currentRequest = null;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'couriers';

	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'name', 
        'email', 
        'password', 
        'mobileNumber'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}