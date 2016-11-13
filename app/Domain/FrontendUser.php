<?php

namespace App\Domain;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Domain\TransactionRequests;

class FrontendUser extends Authenticatable
{
    protected $currentRequest = null;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'frontend_users';

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


    public function hasCurrentRequest()
    {
        $currentRequest = $this->getCurrentRequest();

        return !is_null($currentRequest);
    }

    public function getCurrentRequest()
    {
        $currentRequests = $this->requests
            ->whereIn('status', [
                TransactionRequests::STATUS_VALIDATING, 
                TransactionRequests::STATUS_PROCESSING, 
                TransactionRequests::STATUS_IN_TRANSIT, 
                TransactionRequests::STATUS_DELIVERED, 
                TransactionRequests::STATUS_UNAUTHORIZED,
                TransactionRequests::STATUS_FAILED_VALIDATION
                ]);

        if(!$currentRequests->isEmpty()) {
            $this->currentRequest = $currentRequests->first();
        } else {
            $this->currentRequest = null;
        }

        return $this->currentRequest;
    }

    /**
     * Get the all the requests of the user.
     */
    public function requests()
    {
        return $this->hasMany('App\Domain\TransactionRequests', 'frontendUser_id');
    }
}
