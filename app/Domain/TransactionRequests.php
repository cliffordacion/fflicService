<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class TransactionRequests extends Model
{
    
    protected $fillable = [
    	'frontendUser_id',
        'type',
        'accessionNumber1', 
        'accessionNumber2', 
        'accessionNumber3', 
        'accessionNumber4', 
        'accessionNumber5', 
        'address',
        'bookingSpecifics',
        'latitude', 
        'longitude',
        'status',
        'remarks'
    ];

    const TYPE_LOAN = 1;
    const TYPE_RETURN = 2;

    const STATUS_VALIDATING = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_IN_TRANSIT = 2;
    const STATUS_DELIVERED = 3;

    const STATUS_UNAUTHORIZED = 4;
    const STATUS_FAILED_VALIDATION = 5;

    const STATUS_COMPLETED = 6;
    const STATUS_CANCELLED = 7;

    const STATUS_ARRAY = [
        self::STATUS_VALIDATING => 'Validating',
        self::STATUS_PROCESSING => 'Processing',
        self::STATUS_IN_TRANSIT => 'In Transit',
        self::STATUS_DELIVERED => 'Delivered',
        self::STATUS_UNAUTHORIZED => 'Unauthorized Request',
        self::STATUS_FAILED_VALIDATION => 'Request Validation Failed',
        self::STATUS_COMPLETED => 'Completed',
        self::STATUS_CANCELLED => 'Cancelled'
    ];

    const IN_PROGRESS_STATUS = [
        self::STATUS_VALIDATING => 'Validating',
        self::STATUS_PROCESSING => 'Processing',
        self::STATUS_IN_TRANSIT => 'In Transit',
        self::STATUS_DELIVERED => 'Delivered',
    ];

/**
* Custom Function Goes Here
*/


    public function setAccessionNumbers(array $accessionNumbers) {
    	// dd($accessionNumbers[0]);
    	$this->accessionNumber1 = isset($accessionNumbers[0]) ? $accessionNumbers[0] : null;
    	$this->accessionNumber2 = isset($accessionNumbers[1]) ? $accessionNumbers[1] : null;
    	$this->accessionNumber3 = isset($accessionNumbers[2]) ? $accessionNumbers[2] : null;
    	$this->accessionNumber4 = isset($accessionNumbers[3]) ? $accessionNumbers[3] : null;
    	$this->accessionNumber5 = isset($accessionNumbers[4]) ? $accessionNumbers[4] : null;
    }

    public function getAccessionNumbers() 
    {
        $accssionNumbers = [];

        if(isset($this->accessionNumber1)) {
            $accessionNumbers[] = $this->accessionNumber1;
        }
        if(isset($this->accessionNumber2)) {
            $accessionNumbers[] = $this->accessionNumber2;
        }
        if(isset($this->accessionNumber3)) {
            $accessionNumbers[] = $this->accessionNumber3;
        }
        if(isset($this->accessionNumber4)) {
            $accessionNumbers[] = $this->accessionNumber4;
        }
        if(isset($this->accessionNumber5)) {
            $accessionNumbers[] = $this->accessionNumber5;
        }

        return $accessionNumbers;
    }

    public function isInProgress()
    {
        return array_key_exists($this->status, self::IN_PROGRESS_STATUS);
    }

    public function isNew()
    {
        // dd($this->status === self::STATUS_VALIDATING);
        return $this->status === self::STATUS_VALIDATING;
    }

    public function isInTransit()
    {
        return $this->status === TransactionRequests::STATUS_IN_TRANSIT;
    }

    public function isDelivered()
    {
        return $this->status === TransactionRequests::STATUS_DELIVERED;
    }

    public function getTypeName()
    {
        if ($this->type === self::TYPE_LOAN) {
            return 'Book Loan';
        } elseif ($this->type === self::TYPE_RETURN) {
            return 'Book Return';
        } 

        return '';
    }

    public function getStatusName()
    {
        if(array_key_exists($this->status, self::STATUS_ARRAY)) {
            return self::STATUS_ARRAY[$this->status];
        }
        return '';
    }

    public function cancelTransaction(string $cancelRemarks)
    {
        $this->remarks = $cancelRemarks;
        $this->status = self::STATUS_CANCELLED;
    }

    public function confirmDelivered()
    {
        $this->remarks = 'Transaction Completed Confirmation';
        $this->status = self::STATUS_COMPLETED;
    }

    public function confirmFailed()
    {
        $this->remarks = 'Transaction Failure Confirmation';
        $this->status = self::STATUS_COMPLETED;
    }

    public static function InProgressCollection()
    {
        $transactionRequestCollection = self::whereIn('status', array_keys(self::IN_PROGRESS_STATUS))
            ->get();
        return $transactionRequestCollection;
    }

    /**
     * Get the frontendUser that owns the request.
     */
    public function frontendUser()
    {
        return $this->belongsTo('App\Domain\FrontendUser', 'frontendUser_id');
    }
}
