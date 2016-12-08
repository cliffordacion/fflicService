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
            'name' => 'French Clifford dacion',
            'email' => 'cliffordzen_143@yahoo.co.uk',
            'course' => 'Library Science',
            'college' => 'School of library and information studies',
            'mobileNumber' => '0987654321',
            'id_image_front' => 'id/cliff.jpg',
            'id_image_back' => 'id/cliff.jpg',
            'password' => '$2y$10$a2.bqgmtQnlElkrP87Qy6up0WjMRW3hcv4niWokcTFOQ7x5UJYOoC',
            'activated' => true,
            'created_at' => '2016-06-21 08:28:47',
            'updated_at' => '2016-06-21 08:28:47'
        ));

        FrontendUser::create(array(
            'id' => '2',
            'name' => 'Salve Lyne De Vera',
            'email' => 'salve@yahoo.co.uk',
            'course' => 'BS Biology',
            'college' => 'College of Science',
            'mobileNumber' => '0987654321',
            'id_image_front' => 'id/cliff.jpg',
            'id_image_back' => 'id/cliff.jpg',
            'password' => '$2y$10$a2.bqgmtQnlElkrP87Qy6up0WjMRW3hcv4niWokcTFOQ7x5UJYOoC',
            'activated' => true,
            'created_at' => '2016-06-21 08:28:47',
            'updated_at' => '2016-06-21 08:28:47'
        ));

        FrontendUser::create(array(
            'id' => '3',
            'name' => 'Frank Kenneth Dacion',
            'email' => 'ken@yahoo.co.uk',
            'course' => 'Nursing',
            'college' => 'College of Health Studies',
            'mobileNumber' => '0987654321',
            'id_image_front' => 'id/cliff.jpg',
            'id_image_back' => 'id/cliff.jpg',
            'password' => '$2y$10$a2.bqgmtQnlElkrP87Qy6up0WjMRW3hcv4niWokcTFOQ7x5UJYOoC',
            'created_at' => '2016-06-21 08:28:47',
            'activated' => false,
            'updated_at' => '2016-06-21 08:28:47'
        ));
    }
}
