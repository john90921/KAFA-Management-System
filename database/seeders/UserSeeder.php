<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        //
        DB::table('users')->insert([
            ['role_id' => '1', 'user_name' => 'afiq', 'user_ic' => '111111111111', 'email' => '1@gmail.com', 'password' => Hash::make('11111111'), 'user_gender' => 'Men', 'user_contact' => '0111111111', 'user_verification' => 'testing.pdf', 'created_at' => $now, 'updated_at' => $now],
            ['role_id' => '2', 'user_name' => 'farisha', 'user_ic' => '222222222222', 'email' => '2@gmail.com', 'password' => Hash::make('22222222'), 'user_gender' => 'Women', 'user_contact' => '0222222222', 'user_verification' => 'testing.pdf', 'created_at' => $now, 'updated_at' => $now],
            ['role_id' => '3', 'user_name' => 'adriana', 'user_ic' => '333333333333', 'email' => '3@gmail.com', 'password' => Hash::make('33333333'), 'user_gender' => 'Women', 'user_contact' => '0333333333', 'user_verification' => 'testing.pdf', 'created_at' => $now, 'updated_at' => $now],
            ['role_id' => '4', 'user_name' => 'warsena', 'user_ic' => '444444444444', 'email' => '4@gmail.com', 'password' => Hash::make('44444444'), 'user_gender' => 'Women', 'user_contact' => '0444444444', 'user_verification' => 'testing.pdf', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}