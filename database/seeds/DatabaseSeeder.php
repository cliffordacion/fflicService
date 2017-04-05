<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('BackendUserSeeder');
        $this->call('FrontendUserSeeder');
        $this->call('CourierSeeder');
        $this->call('TransactionRequestSeeder');
    }
}
