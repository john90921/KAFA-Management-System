<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        //
        DB::table('roles')->insert([
            ['role_name' => 'MUIP Administrator', 'created_at' => $now, 'updated_at' => $now],
            ['role_name' => 'KAFA Administrator', 'created_at' => $now, 'updated_at' => $now],
            ['role_name' => 'Parent', 'created_at' => $now, 'updated_at' => $now],
            ['role_name' => 'Teacher', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
