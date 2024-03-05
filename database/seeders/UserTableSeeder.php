<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            //admin
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('111'),
                'phone' => '090',
                'role' => 'admin',
            ],

            //Parent
            [
                'name' => 'parent',
                'email' => 'parent@gmail.com',
                'password' => Hash::make('333'),
                'phone' => '090',
                'role' => 'parent',
            ],

            //Student
            [
                'name' => 'student',
                'email' => 'student@gmail.com',
                'password' => Hash::make('444'),
                'phone' => '090',
                'role' => 'student',
            ],

            //user
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123'),
                'phone' => '090',
                'role' => 'user',
            ],
        ]);
    }
}
