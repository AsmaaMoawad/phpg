<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
        	'Name' => 'Ahmed',
            'email' => 'a@a.com',
        	'phone_number' => '123456789',
        	'password' => bcrypt('123456'),
	        'remember_token' => str_random(10)
        	]);
        $user->attachRole(Role::find(1));
    }
}
