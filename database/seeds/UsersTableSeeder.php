<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'admin';
        $admin->password = bcrypt('123456');
        $admin->email = 'admin@gmail.com';
        $admin->group = 1;
        $admin->save();

        $zuolar = new User();
        $zuolar->name = 'Zuolar';
        $zuolar->password = bcrypt('a7319779');
        $zuolar->email = 'yam8511@gmail.com';
        $zuolar->group = 0;
        $zuolar->save();
    }
}
