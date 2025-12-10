<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Http\Requests\CreateSessionRequest;
use App\Models\Classroom;
use App\Models\Examination;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    // Display the assessment list for teachers
    public function assessmentdetails()
    {
        // Get the current year as a string
        $currentYear = strval(Carbon::now()->year);

        // Retrieve examinations for the current year
        $assessments = Examination::with('results')->where('school_session', $currentYear)->get();

        return view('ManageResult.Teacher.assessment_details', compact('assessments'));
    }

    // Display the student list in the Add Result page based on the selected subject for teachers
    public function displayResult(Request $request, $assessid)
    {
        $assessment = Examination::findOrFail($assessid);
        $subjects = Subject::all();
        $subject = $request->subject_name;
        $students = collect(); // Define an empty collection by default

        // Check if the subject is one of the specified subjects
        if (
            in_array($subject, ['Bidang Al Quran', 'Ulum Syariah', 'Sirah', 'Adab', 'Jawi Dan Khat', 
                                'Lughatul Quran', 'Penghayatan Cara Hidup Islam', 'Amali Solat'])
        ) {
            $id = Auth::id();
            $class = Classroom::where('teacher_id', $id)->first();

            if ($class) {
                $subsid = Subject::where('subject_name', $subject)->first();
                $students = Student::where('classroom_id', $class->id)->get();

                return view('ManageResult.Teacher.add_result', compact('assessment', 'subjects', 'students', 'subsid'));
            }
        }

        return view('ManageResult.Teacher.add_result', compact('assessment', 'subjects', 'students'));
    }

    // Store the added results into the database
    public function addResult(CreateResultRequest $request)
    {
        $userid = Auth::id();

        $data = $request->validated();
        $gradestd = 'N';

        $results = [];
        foreach ($request->student_ids as $student_id) {
            // Determine the grade based on the result marks
            if ($request->result_marks[$student_id] >= 0 && $request->result_marks[$student_id] < 40) {
                $gradestd = 'E';
            } elseif ($request->result_marks[$student_id] >= 40 && $request->result_marks[$student_id] <= 50) {
                $gradestd = 'D';
            } elseif ($request->result_marks[$student_id] > 50 && $request->result_marks[$student_id] <= 60) {
                $gradestd = 'C';
            } elseif ($request->result_marks[$student_id] > 60 && $request->result_marks[$student_id] <= 80) {
                $gradestd = 'B';
            } elseif ($request->result_marks[$student_id] > 80 && $request->result_marks[$student_id] <= 100) {
                $gradestd = 'A';
            }

            // Create an array of results to be inserted
            $results[] = [
                'student_id' => $student_id,
                'subject_id' => $request->subs,
                'user_id' => $userid,
                'examination_id' => $request->assessid,
                'result_marks' => $request->result_marks[$student_id],
                'result_feedback' => $request->result_feedback[$student_id],
                'result_grades' => $gradestd,
                'result_status' => 'Pending',
            ];
        }

        // Insert all records within a transaction
        DB::transaction(function () use ($results) {
            Result::insert($results);
        });

        return redirect()->route('displayResult', ['assessid' => $request->assessid])->with('message', 'Results added successfully!');
    }

    // Display the student list for the edit page based on the selected subject for teachers
    public function updateResult(Request $request, $assessid)
    {
        $assessment = Examination::findOrFail($assessid);
        $subjects = Subject::all();
        $subject = $request->subject_name;
        $students = collect(); // Define an empty collection by default

        // Check if the subject is one of the specified subjects
        if (
            in_array($subject, ['Bidang Al Quran', 'Ulum Syariah', 'Sirah', 'Adab', 'Jawi Dan Khat', 
                                'Lughatul Quran', 'Penghayatan Cara Hidup Islam', 'Amali Solat'])
        ) {
            $id = Auth::id();
            $class = Classroom::where('teacher_id', $id)->first();

            if ($class) {
                $subsid = Subject::where('subject_name', $subject)->first();
                $students = Student::where('classroom_id', $class->id)->get();

                // Get the results for the assessment and subject
                $results = Result::where('examination_id', $assessment->id)->where('subject_id', $subsid->id)->get();

                return view('ManageResult.Teacher.edit_result', compact('assessment', 'subjects', 'students', 'subsid', 'results'));
            }
        }

        return view('ManageResult.Teacher.edit_result', compact('assessment', 'subjects', 'students'));
    }

    // Store the updated results into the database
    public function editResult(UpdateResultRequest $request)
    {
        $data = $request->validated();
        $resultsToUpdate = [];

        foreach ($request->student_ids as $student_id) {
            $existingResult = Result::where('student_id', $student_id)
                ->where('subject_id', $request->subs)
                ->where('examination_id', $request->assessid)
                ->first();

            if (!$existingResult) {
                continue;
            }

            $marks = $request->result_marks[$student_id];
            $gradestd = 'N'; // Update the result grades based on result marks

            if ($marks >= 0 && $marks < 40) {
                $gradestd = 'E';
            } elseif ($marks >= 40 && $marks <= 50) {
                $gradestd = 'D';
            } elseif ($marks > 50 && $marks <= 60) {
                $gradestd = 'C';
            } elseif ($marks > 60 && $marks <= 80) {
                $gradestd = 'B';
            } elseif ($marks > 80 && $marks <= 100) {
                $gradestd = 'A';
            }

            // Update the existing result with the new data
            $existingResult->result_marks = $marks;
            $existingResult->result_feedback = $request->result_feedback[$student_id];
            $existingResult->result_grades = $gradestd;
            $existingResult->result_status = 'Pending';

            $resultsToUpdate[] = $existingResult;
        }

        // Save all updated results within a transaction
        DB::transaction(function () use ($resultsToUpdate) {
            foreach ($resultsToUpdate as $result) {
                $result->save();
            }
        });

        return redirect()->route('assessmentdetails')->with('message', 'Results updated successfully!');
    }

    // Display the Add Session page and store data
    public function addSession()
    {
        $examination = Examination::all();

        return view('ManageResult.KAFA-Admin.add_session', compact('examination'));
    }

    // Store the session into the database
    public function storeSession(CreateSessionRequest $request)
    {
        $data = $request->validated();

        $examination = Examination::create([
            'school_session' => $data['school_session'],
            'exam_type' => $data['exam_type'],
            'approval_status' => 'Pending',
            'exam_comment' => 'None',
        ]);

        $examination->save();

        return redirect()->route('addsession')->with('success', 'Session created successfully!');
    }

    // Delete the existing session
    public function deletesession($id)
    {
        $examination = Examination::findOrFail($id); // Fetch the examination by id
        $examination->delete(); // Delete the session from the database

        return redirect()->route('addsession')->with('success', 'Session deleted successfully!');
    }

    // Display student names based on parents' information
    public function selectresultinfo()
    {
        $parent = Auth::user();
        $children = Student::where('parent_id', $parent->id)->pluck('student_name', 'id'); // display student_name based on parents
        $registeredYears = Examination::orderBy('school_session', 'asc')->pluck('school_session')->unique()->toArray();

        return view('ManageResult.Parent.select_result_info', compact('children', 'registeredYears'));
    }

    // Display the result slip for a student based on the selected session year and exam type
    public function resultslip(Request $request)
    {
        // Find the student
        $student = Student::with('classroom')->findOrFail($request->student_name);

        // Find the examination based on session year and exam type
        $examination = Examination::where('school_session', $request->school_session)
            ->where('exam_type', $request->exam_type)
            ->firstOrFail();

        // Find the results for the student and examination, including subject information
        $results = Result::where('student_id', $student->id)
            ->where('examination_id', $examination->id)
            ->with('subject')
            ->get();

        if ($results->isNotEmpty()) {
            return view('ManageResult.Parent.result_slip', ['student' => $student, 'results' => $results]);
        } else {
            return redirect()->route('result')->with('error', 'Result not found');
        }
    }

    // Display the result approval list for KAFA Admin
    public function resultApprovalList(Request $request)
    {
        $query = Result::with('examination', 'studentresult.classroom', 'subject');

        if ($request->has('school_session') && $request->school_session != '') {
            $query->whereHas('examination', function ($q) use ($request) {
                $q->where('school_session', $request->school_session);
            });
        }

        if ($request->has('exam_type') && $request->exam_type != '') {
            $query->whereHas('examination', function ($q) use ($request) {
                $q->where('exam_type', $request->exam_type);
            });
        }

        $results = $query->get();

        return view('ManageResult.KAFA-Admin.result_approval_list', compact('results'));
    }

    // Display student list for review based on result id for KAFA Admin
    public function studentListReview($result_id)
    {
        $result = Result::where('id', $result_id)->first();

        if (!$result) {
            return redirect()->route('result_approval_list')->with('error', 'Result not found');
        }

        return view('ManageResult.KAFA-Admin.student_list_review', compact('result'));
    }

    // Update the approval status of a result to 'Approved'
    public function updateApproval(Request $request)
    {
        $result = Result::findOrFail($request->result_id);
        $result->result_status = 'Approved';
        $result->save();

        return redirect()->route('studentlistreview', ['result_id' => $request->result_id])->with('message', 'Result status updated successfully');
    }

    // Update the approval status of a result to 'Rejected'
    public function deleteapproval(Request $request)
    {
        $result = Result::findOrFail($request->result_id);
        $result->result_status = 'Rejected';
        $result->save();

        return redirect()->route('studentlistreview', ['result_id' => $request->result_id])->with('message', 'Result status updated successfully');
    }
}
