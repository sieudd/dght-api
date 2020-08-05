<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 => array(
                'id' => 1,
                'name' => 'Nhà hảo tâm',
                'email' => 'donggop@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$10$vwnP47ffMsaZjAdt8jgnZOogqCowzJhaDZk7TuVUaoVWzGOSzinCe',
                'remember_token' => null,
                'founding' => '2020-08-05 13:59:37',
                'phone_number' => '0934123456',
                'type' => 'DONG_GOP',
                'address' => '31 Trần Phú',
                'type_contribute' => 'DOANH_NGHIEP',
                'created_at' => '2020-06-04 13:59:37',
                'updated_at' => '2020-06-18 14:45:22',
            ),
            1 => array(
                'id' => 2,
                'name' => 'Nhà yêu cầu',
                'email' => 'yeucau@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$10$vwnP47ffMsaZjAdt8jgnZOogqCowzJhaDZk7TuVUaoVWzGOSzinCe',
                'remember_token' => null,
                'phone_number' => '0934123456',
                'founding' => null,
                'type' => 'YEU_CAU',
                'address' => '31 Trần Phú',
                'type_contribute' => null,
                'created_at' => '2020-06-04 13:59:37',
                'updated_at' => '2020-06-18 14:45:22',
            ),
            2 => array(
                'id' => 3,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$10$vwnP47ffMsaZjAdt8jgnZOogqCowzJhaDZk7TuVUaoVWzGOSzinCe',
                'remember_token' => null,
                'type' => 'ADMIN',
                'founding' => null,
                'type_contribute' => null,
                'phone_number' => '0934123456',
                'address' => '31 Trần Phú',
                'created_at' => '2020-06-04 13:59:37',
                'updated_at' => '2020-06-18 14:45:22',
            ),
        ));

    }
}
