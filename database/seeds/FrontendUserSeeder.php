<?php

use Illuminate\Database\Seeder;
use App\Domain\FrontendUser;

class FrontendUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('frontend_users')->delete();
        FrontendUser::create(array(
            'id' => '1',
            'name' => 'cliff',
            'email' => 'cliffordzen_143@yahoo.co.uk',
            'password' => '$2y$10$a2.bqgmtQnlElkrP87Qy6up0WjMRW3hcv4niWokcTFOQ7x5UJYOoC',
            'created_at' => '2016-06-21 08:28:47',
            'updated_at' => '2016-06-21 08:28:47'
        ));
    }
}
