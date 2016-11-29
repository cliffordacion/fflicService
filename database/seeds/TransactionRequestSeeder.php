<?php

use Illuminate\Database\Seeder;
use App\Domain\TransactionRequests;

class TransactionRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_requests')->delete();
        TransactionRequests::create(array(
            'id' => '1',
            'frontendUser_id' => 1,
            'type' => 1,
            'accessionNumber1' => 'testing LG Choch',
            'accessionNumber2' => 'testing LG Choch1',
            'accessionNumber3' => 'testing LG Choch2',
            'accessionNumber4' => null,
            'accessionNumber5' => null,
            'address' => '15 Rd 5, Project 6, Quezon City, 1105 Metro Manila, Philippines',
            'bookingSpecifics' => 'tabi tabi lang',
            'latitude' => '14.6607140000000000',
            'longitude' => '121.0326874000000100',
            'status' => 0,
            'remarks' => 'Loan Request',
            'created_at' => '2016-06-21 08:28:47',
            'updated_at' => '2016-06-21 08:28:47'
        ));
        TransactionRequests::create(array(
            'id' => '2',
            'frontendUser_id' => 2,
            'type' => 1,
            'accessionNumber1' => 'testing LG Choch',
            'accessionNumber2' => 'testing LG Choch1',
            'accessionNumber3' => 'testing LG Choch2',
            'accessionNumber4' => null,
            'accessionNumber5' => null,
            'address' => '15 Rd 5, Project 6, Quezon City, 1105 Metro Manila, Philippines',
            'bookingSpecifics' => 'tabi tabi lang',
            'latitude' => '14.6607140000000000',
            'longitude' => '121.0326874000000100',
            'status' => 0,
            'remarks' => 'Loan Request',
            'created_at' => '2016-06-21 08:28:47',
            'updated_at' => '2016-06-21 08:28:47'
        ));
        TransactionRequests::create(array(
            'id' => '3',
            'frontendUser_id' => 3,
            'type' => 1,
            'accessionNumber1' => 'testing LG Choch',
            'accessionNumber2' => 'testing LG Choch1',
            'accessionNumber3' => 'testing LG Choch2',
            'accessionNumber4' => null,
            'accessionNumber5' => null,
            'address' => '15 Rd 5, Project 6, Quezon City, 1105 Metro Manila, Philippines',
            'bookingSpecifics' => 'tabi tabi lang',
            'latitude' => '14.6607140000000000',
            'longitude' => '121.0326874000000100',
            'status' => 2,
            'remarks' => 'Loan Request',
            'created_at' => '2016-06-21 08:28:47',
            'updated_at' => '2016-06-21 08:28:47'
        ));
    }
}
