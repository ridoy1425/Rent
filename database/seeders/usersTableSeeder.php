<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            ['name' => 'ridoy', 'email' => 'ridoy@gmail.com', 'password' => '123456'],
            ['name' => 'roton', 'email' => 'roton@gmail.com', 'password' => '123456'],
            ['name' => 'monir', 'email' => 'monir@gmail.com', 'password' => '123456'],
            ['name' => 'shabab', 'email' => 'shabab@gmail.com', 'password' => '123456']
        ];

        User::insert($users);
    }
}
