<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

// Route for all user
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::put('/profile/{id}', [AccountController::class, 'updateProfile'])->name('profile.update');

    //Manage Bulletin
    Route::get('/bulletinboard', [BulletinController::class, 'bulletinboard'])->name('bulletinboard');
    Route::get('/selectednotices{id}', [BulletinController::class, 'selectednotices'])->name('selectednotices');
});

// Route for MUIP Admin
Route::group(['middleware' => 'role:1'], function () {
    // ManageReport
    Route::get('/listSubject', [ReportController::class, 'listSubject'])->name('listSubject');
    Route::get('/searchExam/{id}', [ReportController::class, 'searchExam'])->name('searchExam');
    Route::get('/gradeReport', [ReportController::class, 'gradeReport'])->name('gradeReport');
    Route::get('/infoReport', [ReportController::class, 'infoReport'])->name('infoReport');
    Route::get('/classReport', [ReportController::class, 'classReport'])->name('classReport');
    Route::get('/addFeedback', [ReportController::class, 'addFeedback'])->name('addFeedback');
    Route::post('/addFeedback', [ReportController::class, 'saveFeedback'])->name('saveFeedback');
    Route::delete('/deleteFeedback/{id}', [ReportController::class, 'deleteFeedback'])->name('deleteFeedback');
    });

// Route for KAFA-Admin
Route::group(['middleware' => 'role:2'], function () {
    // Manage Account
    Route::get('/registerteacher', [AccountController::class, 'registerteacher'])->name('registerteacher');
    Route::post('/registerteacher', [AccountController::class, 'createteacher'])->name('registerteacher.create');

    // Manage Schedule
    Route::get('/all_class', [ScheduleController::class, 'allclass'])->name('allclass');
    Route::get('/add_classroom', [ScheduleController::class, 'addclassroom'])->name('addclassroom');
    Route::post('/add_classroom', [ScheduleController::class, 'createClassroom'])->name('addclassroom.create');
    Route::get('/view_classroom/{id}', [ScheduleController::class, 'viewclassroom'])->name('viewclassroom');

    //Manage Bulletin
    Route::get('/formapproval/{id}', [BulletinController::class, 'formapproval'])->name('formapproval');
    Route::put('/formapproval/{id}', [BulletinController::class, 'updatestatus'])->name('updatestatus');

    //Manage Result
    Route::get('/add_session', [ResultController::class, 'addSession'])->name('addsession');
    Route::post('/add_session', [ResultController::class, 'storeSession'])->name('storeSession');
    Route::delete('/add_session/{id}', [ResultController::class, 'deletesession'])->name('deletesession');
    Route::get('/result_approval_list', [ResultController::class, 'resultapprovallist'])->name('resultapprovallist');
    Route::get('/studentlistreview/{result_id}', [ResultController::class, 'studentListReview'])->name('studentlistreview');
    Route::post('/updateapproval', [ResultController::class, 'updateApproval'])->name('updateapproval');
    Route::post('/deleteapproval', [ResultController::class, 'deleteapproval'])->name('deleteapproval');
});

// Route for Parent
Route::group(['middleware' => 'role:3'], function () {
    // Manage Account
    Route::get('/registerchild', [AccountController::class, 'registerchild'])->name('registerchild');
    Route::post('/registerchild', [AccountController::class, 'createchild'])->name('registerchild.create');

    // Manage Schedule
    Route::get('/child_kafa', [ScheduleController::class, 'childkafa'])->name('childkafa');
    Route::get('/kafa_schedule/{id}', [ScheduleController::class, 'kafaschedule'])->name('kafaschedule');

    //Manage Result
    Route::get('/select_result_info', [ResultController::class, 'selectresultinfo'])->name('selectresultinfo');
    Route::get('/resultslip', [ResultController::class, 'resultslip'])->name('resultslip');
});

// Route for Teacher
Route::group(['middleware' => 'role:4'], function () {
    // Manage Schedule
    Route::get('/class_activity', [ScheduleController::class, 'classactivity'])->name('classactivity');
    Route::get('/new_activity', [ScheduleController::class, 'newactivity'])->name('newactivity');
    Route::post('/new_activity', [ScheduleController::class, 'createClassActivity'])->name('newactivity.create');
    Route::get('/activity_details/{id}', [ScheduleController::class, 'activitydetails'])->name('activitydetails');
    Route::put('/activity_details/{id}', [ScheduleController::class, 'UpdateClassactivity'])->name('activitydetails.update');
    Route::delete('/activity_details/{id}', [ScheduleController::class, 'deleteClassActivity'])->name('activitydetails.delete');

    // Manage Result
    Route::get('/assessment_details', [ResultController::class, 'assessmentdetails'])->name('assessmentdetails');
    Route::get('/add_result/{assessid}', [ResultController::class, 'displayResult'])->name('displayResult');
    Route::post('/add_result/{assessid}', [ResultController::class, 'addResult'])->name('addResult');
    Route::get('/editResult/{assessid}', [ResultController::class, 'updateResult'])->name('updateResult');
    Route::put('/editResult/{assessid}', [ResultController::class, 'editResult'])->name('editResult');
});

Route::group(['middleware' => ['role:1,2,4']], function () {
    //Manage Bulletin
    Route::get('/allnotices', [BulletinController::class, 'allnotices'])->name('allnotices');
    Route::get('/noticeform', [BulletinController::class, 'noticeform'])->name('noticeform');
    Route::post('/createnotice', [BulletinController::class, 'createnotice'])->name('createnotice');
    Route::delete('/allnotices/{id}', [BulletinController::class, 'deletenotice'])->name('deletenotice');
});


Route::group(['middleware' => 'role:1,2'], function () {
    // Manage Report
    Route::get('/listFeedback', [ReportController::class, 'listFeedback'])->name('listFeedback');
});

