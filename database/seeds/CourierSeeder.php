<?php

use Illuminate\Database\Seeder;
use App\Domain\Courier;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('couriers')->delete();
        Courier::create(array(
            'id' => '1',
            'name' => 'French Clifford dacion',
            'email' => 'cliffordzen_143@yahoo.co.uk',
            'mobileNumber' => '0987654321',
            'password' => '$2y$10$a2.bqgmtQnlElkrP87Qy6up0WjMRW3hcv4niWokcTFOQ7x5UJYOoC',
            'activated' => true,
            'created_at' => '2016-06-21 08:28:47',
            'updated_at' => '2016-06-21 08:28:47'
        ));

        Courier::create(array(
            'id' => '2',
            'name' => 'Salve Lyne De Vera',
            'email' => 'salve@yahoo.co.uk',
            'mobileNumber' => '0987654321',
            'password' => '$2y$10$a2.bqgmtQnlElkrP87Qy6up0WjMRW3hcv4niWokcTFOQ7x5UJYOoC',
            'activated' => true,
            'created_at' => '2016-06-21 08:28:47',
            'updated_at' => '2016-06-21 08:28:47'
        ));
    }
}
