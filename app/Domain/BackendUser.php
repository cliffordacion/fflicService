<?php

namespace App\Domain;

use Illuminate\Foundation\Auth\User as Authenticatable;

class BackendUser extends Authenticatable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'backend_users';

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
}
