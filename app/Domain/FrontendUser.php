<?php

namespace App\Domain;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Domain\TransactionRequests;

class FrontendUser extends Authenticatable
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
    protected $table = 'frontend_users';

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
        'course', 
        'college', 
        'mobileNumber', 
        'id_image_front', 
        'id_image_back', 
        'activated'
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

    public static function register($request)
    {
        $params = $request->all();

        $user = new self;
        $user->id = $params['studentId'];
        $user->name = $params['name'];
        $user->email = $params['email'];
        $user->password = bcrypt($params['password']);
        $user->course = $params['course'];
        $user->college = $params['college'];
        $user->mobileNumber = $params['mobileNumber'];
        $user->activated = self::ACTIVATION_FALSE;
        $user->save();
        
        return $user;
    }

    public function activate()
    {
        $this->activated = self::ACTIVATION_TRUE;
        $this->save();
    }
}