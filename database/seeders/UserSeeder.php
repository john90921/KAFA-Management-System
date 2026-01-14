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
        
        // Default accounts for each role type
        // All accounts use password: "password123"
        $defaultPassword = Hash::make('password123');
        
        DB::table('users')->insert([
            // MUIP Administrator (Role ID: 1)
            [
                'role_id' => 1,
                'user_name' => 'MUIP Administrator',
                'user_ic' => '100000000001',
                'email' => 'muip.admin@kafa.test',
                'password' => $defaultPassword,
                'user_gender' => 'Men',
                'user_contact' => '0100000001',
                'user_verification' => 'default.pdf',
                'created_at' => $now,
                'updated_at' => $now
            ],
            // KAFA Administrator (Role ID: 2)
            [
                'role_id' => 2,
                'user_name' => 'KAFA Administrator',
                'user_ic' => '200000000002',
                'email' => 'kafa.admin@kafa.test',
                'password' => $defaultPassword,
                'user_gender' => 'Women',
                'user_contact' => '0200000002',
                'user_verification' => 'default.pdf',
                'created_at' => $now,
                'updated_at' => $now
            ],
            // Parent (Role ID: 3)
            [
                'role_id' => 3,
                'user_name' => 'Test Parent',
                'user_ic' => '300000000003',
                'email' => 'parent@kafa.test',
                'password' => $defaultPassword,
                'user_gender' => 'Women',
                'user_contact' => '0300000003',
                'user_verification' => 'default.pdf',
                'created_at' => $now,
                'updated_at' => $now
            ],
            // Teacher (Role ID: 4)
            [
                'role_id' => 4,
                'user_name' => 'Test Teacher',
                'user_ic' => '400000000004',
                'email' => 'teacher@kafa.test',
                'password' => $defaultPassword,
                'user_gender' => 'Men',
                'user_contact' => '0400000004',
                'user_verification' => 'default.pdf',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}