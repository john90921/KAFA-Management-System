<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder sets up test data for CSV upload testing:
     * - Creates a classroom
     * - Assigns teacher to classroom
     * - Assigns students to classroom
     * - Creates an examination session
     */
    public function run(): void
    {
        $now = now();
        $currentYear = Carbon::now()->year;

        // Get the teacher user (Role ID 4, should be the 4th user)
        $teacher = DB::table('users')
            ->where('role_id', 4)
            ->where('user_ic', '400000000004')
            ->first();

        if (!$teacher) {
            $this->command->error('Teacher account not found! Please run UserSeeder first.');
            return;
        }

        // Get the parent user (Role ID 3)
        $parent = DB::table('users')
            ->where('role_id', 3)
            ->where('user_ic', '300000000003')
            ->first();

        if (!$parent) {
            $this->command->error('Parent account not found! Please run UserSeeder first.');
            return;
        }

        // Check if classroom already exists for this teacher
        $existingClassroom = DB::table('classrooms')
            ->where('teacher_id', $teacher->id)
            ->first();

        if ($existingClassroom) {
            $classroomId = $existingClassroom->id;
            $this->command->info("Using existing classroom '{$existingClassroom->class_name}' (ID: $classroomId).");
        } else {
            // Create a classroom and assign teacher
            $classroomId = DB::table('classrooms')->insertGetId([
                'class_name' => 'Test Class A',
                'class_description' => 'Test classroom for CSV upload functionality',
                'teacher_id' => $teacher->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $this->command->info("Created classroom 'Test Class A' (ID: $classroomId) and assigned teacher.");
        }

        // Get all students that don't have a classroom yet
        $unassignedStudents = DB::table('students')
            ->whereNull('classroom_id')
            ->get();

        // If no unassigned students, create some test students
        if ($unassignedStudents->isEmpty()) {
            $testStudentIds = DB::table('students')->insertGetId([
                'classroom_id' => $classroomId,
                'parent_id' => $parent->id,
                'student_name' => 'Test Student 1',
                'student_ic' => '111111111110',
                'student_age' => 11,
                'student_gender' => 'Men',
                'student_verification' => 'test.pdf',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('students')->insert([
                [
                    'classroom_id' => $classroomId,
                    'parent_id' => $parent->id,
                    'student_name' => 'Test Student 2',
                    'student_ic' => '222222222220',
                    'student_age' => 12,
                    'student_gender' => 'Women',
                    'student_verification' => 'test.pdf',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'classroom_id' => $classroomId,
                    'parent_id' => $parent->id,
                    'student_name' => 'Test Student 3',
                    'student_ic' => '333333333330',
                    'student_age' => 13,
                    'student_gender' => 'Men',
                    'student_verification' => 'test.pdf',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]);

            $assignedCount = 3;
            $this->command->info("Created 3 test students and assigned them to the classroom.");
        } else {
            // Assign unassigned students to the classroom
            $assignedCount = 0;
            foreach ($unassignedStudents as $student) {
                DB::table('students')
                    ->where('id', $student->id)
                    ->update([
                        'classroom_id' => $classroomId,
                        'updated_at' => $now,
                    ]);
                $assignedCount++;
            }
            $this->command->info("Assigned $assignedCount unassigned student(s) to the classroom.");
        }

        // Also ensure existing students from StudentSeeder are assigned if they're not
        $existingStudents = DB::table('students')
            ->whereIn('student_ic', ['111111111110', '222222222220', '333333333330'])
            ->where('classroom_id', '!=', $classroomId)
            ->orWhereNull('classroom_id')
            ->get();

        foreach ($existingStudents as $student) {
            DB::table('students')
                ->where('id', $student->id)
                ->update([
                    'classroom_id' => $classroomId,
                    'updated_at' => $now,
                ]);
            $assignedCount++;
        }

        // Create an examination session for the current year
        $examinationId = DB::table('examinations')->insertGetId([
            'school_session' => (string) $currentYear,
            'exam_type' => 'Ujian Pertengahan Tahun',
            'approval_status' => 'Pending',
            'exam_comment' => 'Test examination for CSV upload',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->command->info("Created examination session for year $currentYear (ID: $examinationId).");

        // Display summary
        $this->command->newLine();
        $this->command->info('=== Test Setup Complete ===');
        $this->command->info("Classroom ID: $classroomId");
        $this->command->info("Teacher: {$teacher->user_name} (IC: {$teacher->user_ic})");
        $this->command->info("Students assigned: $assignedCount");
        $this->command->info("Examination ID: $examinationId");
        $this->command->newLine();
        $this->command->info('You can now login as Teacher (IC: 400000000004) to test CSV upload!');
    }
}
