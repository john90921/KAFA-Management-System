<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Result;
use App\Models\Examination;
use App\Models\Classroom;
use App\Models\Feedback;
use App\Models\Student;
use App\Http\Requests\addFeedbackRequest;
use App\Http\Requests\CreateFeedbackRequest;

class ReportController extends Controller
{
    //display list subject (MUIP)
    public function listSubject() {             
        $subjects = Subject::all();             //fetch all subject

        return view('ManageReport.MUIP-Admin.listSubject', compact('subjects'));
    }

    //select examination and class
    public function searchExam($id) {
        $examinations = Examination::All();     //fetch all examination
        $classes = Classroom::All();            //fetch all classroom
        $subject = Subject::findOrFail($id);    //fetch subject based on the id

        return view('ManageReport.MUIP-Admin.searchExam', compact('examinations', 'classes', 'subject'));
    }

    //display bar chart for student get grade each subject
    public function gradeReport(Request $request) {

        $examination = Examination::where('id', $request->exam_id)->first();
    
        // Fetch the class record based on the class ID
        $class = Classroom::findOrFail($request->class);
    
        // Fetch the students based on the classroom ID
        $students = Student::where('classroom_id', $class->id)->get();
    
        // Initialize an empty array to store grades and their corresponding student counts
        $gradeCounts = [];
    
        foreach ($students as $student) {
            $studentResults = Result::where('student_id', $student->id)
                                    ->where('subject_id', $request->subject)
                                    ->where('examination_id', $examination->id)
                                    ->first();
    
            if ($studentResults) {
                $grade = $studentResults->result_grades;
    
                // Increment the count for this grade
                if (!isset($gradeCounts[$grade])) {
                    $gradeCounts[$grade] = 1;
                } else {
                    $gradeCounts[$grade]++;
                }
            }
        }
    
        // Prepare data for the chart
        $chartData = [
            'labels' => [], // Array to hold grades
            'data' => [],   // Array to hold total students for each grade
        ];
    
        // Now populate chart data with grades and their corresponding student counts
        foreach ($gradeCounts as $grade => $count) {
            $chartData['labels'][] = $grade; // Store grade as label
            $chartData['data'][] = $count;   // Store count as data point
        }
    
        return view('ManageReport.MUIP-Admin.gradeReport', compact('chartData'));
    }
    
    //display info (select examination and class)
    public function infoReport() {
        $examinations = Examination::All();  // retrieve examination
        $classes = Classroom::All();        //  fetch all classroom

        return view('ManageReport.MUIP-Admin.infoReport', compact('examinations', 'classes'));
    }

    //MUIP display pie chart 
    public function classReport(Request $request) {

        $examination = Examination::where('id', $request->exam_id)->first();
    
        // Fetch the class record based on the class ID
        $class = Classroom::findOrFail($request->class);  
    
        // Fetch the students based on the classroom ID
        $students = Student::where('classroom_id', $class->id)->get();
    
        // Initialize counters for passed and failed students
        $passCount = 0;
        $failCount = 0;
    
        foreach ($students as $student) {
            $studentResults = Result::where('student_id', $student->id)
                                    ->where('examination_id', $examination->id)
                                    ->first();
    
            if ($studentResults) {
                $mark = $studentResults->result_marks; // Assuming `result_marks` holds the actual marks
    
                if ($mark >= 40) {
                    $passCount++;
                } else {
                    $failCount++;
                }
            }
        }

    
        // Calculate the percentage of students who passed and failed
        $totalStudents = $passCount + $failCount;
        $passPercentage = ($totalStudents != 0) ? ($passCount / $totalStudents) * 100 : 0;
        $failPercentage = ($totalStudents != 0) ? ($failCount / $totalStudents) * 100 : 0;
    
        // Prepare data for the pie chart
        $chartData = [
            'labels' => ['Passed', 'Failed'],
            'data' => [$passPercentage, $failPercentage],
        ];
    
        return view('ManageReport.MUIP-Admin.classReport', compact('chartData'));
    }
    

    //feedback form (MUIP)
    public function addFeedback() {

        return view('ManageReport.MUIP-Admin.addFeedback');
    }

    //save feedback form
    public function saveFeedback (CreateFeedbackRequest $request) {

        $data = $request->validated();

        $feedback = Feedback::create([
            'feedback_title'=> $data['feedback_title'],
            'feedback_description'=> $data['feedback_description'],
        ]);

        $feedback->save();  // save feedback
        
        return redirect()->route('addFeedback')->with('message', 'Feedback Successfully Saved!');
    }

    //list feedback table (MUIP and KAFA)
    public function listFeedback() {
        // Retrieve all feedback records from the database
        $feedbacks = Feedback::all();    
    
        // Return the view with feedback data
        return view('ManageReport.listFeedback', compact('feedbacks'));
        
    }

    //MUIP delete feedback
    public function deleteFeedback($id) {
        $feedbacks = Feedback::findOrFail($id); // fetch class feedback based on the id

        $feedbacks->delete(); // delete feedback from database

        return redirect()->route('listFeedback')->with('message', 'Successfully Deleted Feedback');
    }

}

