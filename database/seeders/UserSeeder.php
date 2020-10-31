<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'fullname'  =>  'Bryan Rafsanzani',
            'email'     =>  'bryan@mail.com',
            'username'  =>  'bryanrafsanzani',
            'password'  =>  bcrypt('53cr3t#'),
        ];

        User::create($user);
    }
}
