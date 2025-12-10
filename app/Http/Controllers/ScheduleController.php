<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\CreateClassRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    // display classroom in all_class page
    public function allclass() {
        $classes = Classroom::all(); // fetch all classroom

        return view('ManageSchedule.KAFA-Admin.all_class', compact('classes'));
    }

    // display class detail in view_classroom
    public function viewclassroom($id) {
        $class = Classroom::findOrFail($id); // fetch classroom based on the id
        $students = Student::where('classroom_id', $class->id)->get(); // fetch student that are registered in the class

        return view('ManageSchedule.KAFA-Admin.view_classroom', compact('class', 'students'));
    }

    // display add_classroom form page
    public function addclassroom() {
        $teachers = User::where('role_id', 4)
                    ->whereNotIn('id', function ($query) {
                    $query->select('teacher_id')->from('classrooms');
                    })->get(); // fetch registered teacher that not have class yest

        $students = Student::all()->where('classroom_id', null); // fetch all student that not registered into classroom yet 

        return view('ManageSchedule.KAFA-Admin.add_classroom', compact('teachers', 'students'));
    }

    // display class activity in class_activity page
    public function classactivity() {
        $user = Auth::user(); // retrieve authenticated user(teacher)
        $class = Classroom::where('teacher_id', $user->id)->first(); // fetch class that been teach by the teacher(user) based on the teacher's id

        // check if class is exist
        if($class != null) {
            $activities = $class->activities()
                        ->orderBy('activity_date')
                        ->orderBy('activity_starttime')
                        ->get(); // fetch all class activity and order by activity date then activity start time
    
            // transform format
            $activities->transform(function ($activity) {
                return $this->reformatActivities($activity);
            });

            $nextDates = $this->getDates(); // get dates
    
            return view('ManageSchedule.Teacher.class_activity', compact('class', 'activities', 'nextDates'));
        } else {
            return view('ManageSchedule.Teacher.class_activity', compact('class'));
        }
    }

    // display new_activity form page
    public function newactivity() {
        $subjects = Subject::all(); // retrieve all subject

        return view('ManageSchedule.Teacher.new_activity', compact('subjects'));
    }

    // display activity details in activity_details page
    public function activitydetails($id) {
        $activity = Activity::findOrFail($id); //fetch activity details based on the id
        $subjects = Subject::all(); // fetch all subject

        $subject = $activity->subject->id; // tetrieve subject name associate with the activity

        return view('ManageSchedule.Teacher.activity_details', compact('activity', 'subject', 'subjects'));
    }

    // display registered kafa child in chil_kafa page
    public function childkafa() {
        $parent = Auth::user(); // retrieve authenticated user(parent)
        $childs = Student::where('parent_id', $parent->id)->get(); // fetch child data based on the user(parent) id

        return view('ManageSchedule.Parent.child_kafa', compact('childs'));
    }

    // display kafa activity schedule in kafa_schedule page.
    public function kafaschedule($id) {
        $activities = Activity::where('classroom_id', $id)->get(); //retrieve activities based on the classroom id
        $class = Classroom::findOrFail($id); // retrieve class based on the classroom id

        // transform format
        $activities->transform(function ($activity) {
            return $this->reformatActivities($activity);
        });

        $nextDates = $this->getDates(); // get dates
        
        return view('ManageSchedule.Parent.kafa_schedule', compact('activities', 'class', 'nextDates'));
    }

    // reformat activity date, start and end time 
    protected function reformatActivities($activity) {
        // transform format
        $activity->activity_date = Carbon::parse($activity->activity_date)->format('j F Y'); // reformat activity date
        $activity->activity_starttime = Carbon::parse($activity->activity_starttime)->format('h:i A'); // reformat activity start time
        $activity->activity_endtime = Carbon::parse($activity->activity_endtime)->format('h:i A'); // reformat activity end time

        return $activity;
    }

    // get 5 days of dates 
    protected function getDates() {
        // get today date
        $todayDate = Carbon::now();

        // generate list of date for 5 days
        $nextDates = [];
        for ($i = 1; $i <= 5; $i++) {
            $nextDates[] = Carbon::parse($todayDate->addDays()->toDateString())->format('j F Y'); // retrieve and reformat date
        }

        return $nextDates;
    }

    // create classroom post method
    public function createClassroom(CreateClassRequest $request) {
        $data = $request->validated(); // validate the request input
        
        // create classroom
        $class = Classroom::create([
            'class_name' => $data['class_name'],
            'class_description' => $data['class_description'],
            'teacher_id' => $data['class_teacher'],
        ]);

        $class->save(); // save class in the database

        $selectedStudentIds = $request->input('add_std'); // input request selected student

        // assign student to the classroom
        foreach($selectedStudentIds as $std_id) {
            $student = Student::findOrFail($std_id); // find student based on the student id
            $student->classroom_id = $class->id; // update student's classroom id to the class id
            $student->save(); // save data in database
        }
        
        return redirect()->route('addclassroom')->with('message', 'Successfully Create New Class');
    }

    // create activity post method
    public function createClassActivity(CreateActivityRequest $request) {

        try {
            $data = $request->validated(); // validate the request input
    
            $user = Auth::user(); // retrieve authenticated user(teacher)
            $class = Classroom::where('teacher_id', $user->id)->first(); // fetch classroom based on the user(teacher) id
    
            // create activity
            $activity = Activity::create([
                'classroom_id' => $class->id,
                'subject_id' => $data['subject_activity'],
                'activity_name' => $data['activity_name'],
                'activity_description' => $data['activity_description'],
                'activity_date' => $data['activity_date'],
                'activity_starttime' => $data['activity_starttime'],
                'activity_endtime' => $data['activity_endtime'],
                'activity_remarks' => $data['activity_remarks'],
            ]);
    
            $activity->save(); // save activity in database
    
            return redirect()->route('classactivity')->with('message', 'Successfully Create New Activity');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('error'); // return the error
        }
        
    }

    // update class activity put method
    public function updateClassActivity(UpdateActivityRequest $request, $id) {

        try {
            $activity = Activity::findOrFail($id); // fetch activity based on the id

            $validatedData = $request->validated(); // validate request input

            // update activity and save in database
            $activity->update([
                'subject_id' => $validatedData['subject'],
                'activity_name' => $validatedData['activity_name'],
                'activity_description' => $validatedData['activity_description'],
                'activity_date' => $validatedData['activity_date'],
                'activity_starttime' => $validatedData['activity_starttime'],
                'activity_endtime' => $validatedData['activity_endtime'],
                'activity_remarks' => $validatedData['activity_remarks'],
            ]);

            return redirect()->route('activitydetails', ['id' => $activity->id])->with('message', 'Successfully Update Activity');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('error'); // return the error
        }
        
    }

    // delete class activity delete  method
    public function deleteClassActivity($id) {
        $activity = Activity::findOrFail($id); // fetch class activity based on the id

        $activity->delete(); // delete activity from database

        return redirect()->route('classactivity')->with('message', 'Successfully Delete Activity');
    }
}