<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        //

        DB::table('students')->insert([
            ['classroom_id' => NULL, 'parent_id' => 3, 'student_name' => 'child1', 'student_ic' => '111111111110', 'student_age' => (int) 11, 'student_gender' => 'Men', 'student_verification' => 'child_ic.pdf', 'created_at' => $now, 'updated_at' => $now],
            ['classroom_id' => NULL, 'parent_id' => 3, 'student_name' => 'child2', 'student_ic' => '222222222220', 'student_age' => (int) 12, 'student_gender' => 'Women', 'student_verification' => 'child_ic.pdf', 'created_at' => $now, 'updated_at' => $now],
            ['classroom_id' => NULL, 'parent_id' => 3, 'student_name' => 'child3', 'student_ic' => '333333333330', 'student_age' => (int) 13, 'student_gender' => 'Men', 'student_verification' => 'child_ic.pdf', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
