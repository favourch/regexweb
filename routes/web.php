<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();

Route::get('/', 'LecturerController@index');

Route::get('/change-password','HomeController@changePassword');
Route::get('/change-profile-pic','HomeController@getChangeProfilePic');

Route::post('/course-details','HomeController@postCourseDetails');
Route::post('/change-password','HomeController@postChangePassword');
Route::post('/change-profile-pic','HomeController@postChangeProfilePic');

Route::post('/student-login','HomeController@studentLogin');
Route::post('/student-transcript','HomeController@studentTranscript');
Route::post('/student-change-password','HomeController@postStudentChangePassword');
Route::post('/student-send-comment','HomeController@postStudentCommment');

//admin routes
Route::get('/admins', 'AdminController@getIndex');
Route::get('/admins/add-students', 'AdminController@addStudents');
Route::get('/admins/change-roles', 'AdminController@changeRoles');
Route::get('/admins/update-users', 'AdminController@updateUsers');
Route::get('/admins/settings','AdminController@getSettings');
Route::get('/admins/messages','AdminController@messages');

Route::post('/admins/add-students', 'AdminController@postAddStudents');
Route::post('/admins/bulk-add-students', 'AdminController@postBulkAddStudents');
Route::post('/admins/change-roles', 'AdminController@postChangeRoles');
Route::post('/admins/roll-semester','AdminController@postRollSemester');

//dean routes
Route::get('/deans', 'DeanController@getIndex');
Route::get('/deans/add-courses', 'DeanController@addCourses');
Route::get('/deans/view-courses', 'DeanController@viewCourses');
Route::get('/deans/approve-results', 'DeanController@approveResults');
Route::get('/deans/view-results/{batchNumber}', 'DeanController@viewResults');
Route::get('/deans/view-reports','DeanController@viewReports');
Route::get('/deans/get-stats/{cid}','DeanController@getCourseStats');
Route::get('/deans/messages','DeanController@messages');
Route::get('/deans/view-transcript','DeanController@viewTranscript');
Route::get('/deans/{indexNo}','DeanController@viewStudentTranscript');
Route::get('/deans/download/{indexNo}','DeanController@downloadPDF');

Route::post('/deans/approve/{batchNumber}', 'DeanController@postApproveResults');
Route::post('/deans/reject/{batchNumber}', 'DeanController@postRejectResults');



//hod routes
Route::get('/hods', 'HodController@getIndex');
Route::get('/hods/result-report','HodController@resultReport');
Route::get('/hods/download-result-report','HodController@downloadResultReport');
Route::get('/hods/add-courses', 'HodController@addCourses');
Route::get('/hods/messages','HodController@messages');
Route::get('/hods/assign-courses', 'HodController@assignCourses');
Route::get('/hods/view-courses', 'HodController@viewCourses');
Route::get('/hods/get-stats/{cid}','HodController@getCourseStats');
Route::get('/hods/approve-results', 'HodController@approveResults');
Route::get('/hods/view-results/{batchNumber}', 'HodController@viewResults');
Route::get('/hods/add-students', 'HodController@addStudents');
Route::get('/hods/view-transcript','HodController@viewTranscript');
Route::get('/hods/view-reports','HodController@viewReports');
Route::get('/hods/{indexNo}','HodController@viewStudentTranscript');
Route::get('/hods/download/{indexNo}','HodController@downloadPDF');



Route::post('/hods/assign-courses', 'HodController@postAssignCourses');
Route::post('/hods/add-courses', 'HodController@postAddCourses');
Route::post('/hods/bulk-add-courses', 'HodController@postBulkAddCourses');
Route::post('/hods/approve/{batchNumber}', 'HodController@postApproveResults');
Route::post('/hods/reject/{batchNumber}', 'HodController@postRejectResults');
Route::post('/hods/add-students', 'HodController@postAddStudents');
Route::post('/hods/bulk-add-students', 'HodController@postBulkAddStudents');



//lecturer routes
Route::get('/lecturers','LecturerController@index');
Route::get('/lecturers/messages','LecturerController@messages');
Route::get('/lecturers/responses','LecturerController@responses');
Route::get('/lecturers/upload','LecturerController@upload');
Route::get('/lecturers/view-results','LecturerController@viewResults');
Route::get('/extract','LecturerController@extract');
Route::get('/logout','LecturerController@logout');

Route::get('/courses/{level}/{semester}','HomeController@getCourses');

Route::post('/lecturers/upload','LecturerController@postUpload');


// Messaging routes
Route::get('/messages','HomeController@getMessages');
Route::post('/messages','HomeController@getMessages');
Route::get('/getStaffMessageUsers','HomeController@getStaffMessageUsers');
Route::post('/sendMessage','HomeController@postSendMessage');
Route::post('/setMessageRead','HomeController@setMessageRead');

Route::get('/test/{sid}','HomeController@test');
Route::get('test','DeanController@downloadPDF');