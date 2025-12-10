<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoticeRequest;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class BulletinController extends Controller
{
    //Display all notices
    public function allnotices(Request $request)
    {
        $status = $request->notice_status;

        if ($status === 'Pending' || $status === 'Approved' || $status === 'Rejected') {
            $notices = Notice::where('notice_status', $status)->get();

            return view('ManageBulletin.all_notices', compact('notices', 'status'));
        } else {
            $notices = Notice::all(); // fetch all notices

            $status = "null";

            return view('ManageBulletin.all_notices', compact('notices', 'status'));
        }
    }


    //Display notice form
    public function noticeform()
    {
        return view('ManageBulletin.notice_form');
    }

    //Create notice
    public function createnotice(CreateNoticeRequest $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $date = Date::now();
        // validate input request
        $data = $request->validated();

        // Determine the notice status based on the user's role
        $noticeStatus = ($user->role_id == 1 || $user->role_id == 2) ? 'Approved' : 'Pending';

        // Create the notice with the determined status
        $class = Notice::create([
            'user_id' => $id,
            'notice_title' => $data['notice_title'],
            'notice_text' => $data['notice_text'],
            'notice_poster' => isset($path) ? $path : 'path',
            'notice_submission_date' => $date,
            'notice_status' => $noticeStatus,
        ]);


        if (request()->hasFile('notice_poster')) {
            $file = request()->file('notice_poster');
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('Notice Poster', $fileName, 'public');
            $class->notice_poster = $path;
            $class->save();
        }
        return redirect()->route('allnotices')->with('message', 'Notice Successfully Submitted!');
    }

    //Delete notice
    public function deletenotice($id)
    {
        $notice = Notice::findOrFail($id); //fetch notice based on the id
        $notice->delete(); // delete notice from database

        return redirect()->route('allnotices')->with('message', 'Notice Successfully Deleted!');
    }

    //Display bulletin board
    public function bulletinboard()
    {
        $notices = Notice::all(); // fetch all notices
        return view('ManageBulletin.bulletinboard', compact('notices'));
    }

    //Dislay selected notices
    public function selectednotices($id)
    {
        $notice = Notice::findOrFail($id); //fetch notice details based on the id
        $user = $notice->user->user_name; // retrieve notice title and text associate with the user id 

        return view('ManageBulletin.selected_notices', compact('notice', 'user'));
    }

    //Dislay selected notices for KAFA Admin to approve
    public function formapproval($id)
    {
        $notice = Notice::findOrFail($id); //fetch notice details based on the id
        $user = $notice->user->user_name; // retrieve notice title and text associate with the user id 

        return view('ManageBulletin.form_approval', compact('notice', 'user'));
    }

    //Approve notice
    public function updatestatus(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);

        // Check the action parameter to determine whether to approve or reject
        if ($request->action == 'Approve') {
            $notice->notice_status = 'Approved'; // Set status to 'approved'
            // Save the updated status
            $notice->save();
            // Redirect to the notices list with a success message
            return redirect()->route('allnotices')->with('message', 'Notice Successfully Approved!');
        } elseif ($request->action == 'Reject') {
            $notice->notice_status = 'Rejected'; // Set status to 'rejected'
            // Save the updated status
            $notice->save();
            // Redirect to the notices list with a success message
            return redirect()->route('allnotices')->with('message', 'Notice Successfully Rejected!');
        }
    }
}
