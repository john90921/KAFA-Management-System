<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        //

        DB::table('subjects')->insert([
            ['subject_name' => 'Bidang Al Quran', 'created_at' => $now, 'updated_at' => $now],
            ['subject_name' => 'Ulum Syariah', 'created_at' => $now, 'updated_at' => $now],
            ['subject_name' => 'Sirah', 'created_at' => $now, 'updated_at' => $now],
            ['subject_name' => 'Adab', 'created_at' => $now, 'updated_at' => $now],
            ['subject_name' => 'Jawi Dan Khat', 'created_at' => $now, 'updated_at' => $now],
            ['subject_name' => 'Lughatul Quran', 'created_at' => $now, 'updated_at' => $now],
            ['subject_name' => 'Penghayatan Cara Hidup Islam', 'created_at' => $now, 'updated_at' => $now],
            ['subject_name' => 'Amali Solat', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}



