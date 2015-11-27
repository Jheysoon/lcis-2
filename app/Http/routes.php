<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('/', 						'Main@index');
Route::get('logout', 					'Main@logout');

Route::get('manage_curriculum',         'Dean\Curriculum@manage_curriculum');
Route::get('view_curriculum/{id}',      'Dean\Curriculum@view_curriculum');
Route::get('delete_subject_cur/{id}',   'Dean\Curriculum@destroy');
Route::get('delete_cur/{id}',           'Dean\Curriculum@delete');
Route::get('manage_section', 			'Dean\ManageSection@index');
Route::get('add_day_period_list',		'Dean\AddDayPeriod@dayPeriod_list');
Route::get('add_day_period/{id}', 		'Dean\AddDayPeriod@add_day_period');
Route::get('assign_instructor', 		'Dean\AssignInstructor@index');
Route::get('instructor_sched_list',     'Dean\AssignInstructor@instructor_sched_list');
Route::get('subject_list',              'Dean\Subject@index');
Route::get('subject/{id}',              'Dean\Subject@show');
Route::get('studentlist',               'Dean\StudentList@index');
Route::get('evaluate/{id}',             'Dean\Evaluation@index');
Route::post('copy_curriculum',          'Dean\Curriculum@copy');
Route::post('curriculum/insert_subject','Dean\Curriculum@insert');
Route::post('save_instructor',          'Dean\AssignInstructor@save_instructor');

Route::get('stat',						'Edp\Stat@index');
Route::get('initClassallocation', 		'Edp\ClassAlloc@init');
Route::get('room_subj', 				'Edp\RoomSubj@index');
Route::get('classRooms', 				'Edp\Room@index');
Route::get('room_sched/{id}', 			'Edp\Room@room');
Route::post('load_stat', 				'Edp\Stat@load_stat');
Route::post('studentcount', 			'Edp\Stat@studentcount');

Route::get('instructor/{id}',           'Instructor\Sched@show');
Route::get('class_list',                'Instructor\InstructorClass@index');
Route::get('class/{id}',                'Instructor\InstructorClass@show');
Route::post('save_grade',               'Instructor\SaveGrade@index');

Route::get('registration',              'Registrar\Registration@new_student');
Route::get('registration/{id}',         'Registrar\PendingRegistration@show');
Route::get('update_registration',       'Registrar\UpdateRegistration@index');
Route::get('update_registration/{id}',  'Registrar\UpdateRegistration@show');
Route::get('shift_student',             'Registrar\ShiftRegistration@index');
Route::get('shift_student/{id}',        'Registrar\ShiftRegistration@show');
Route::get('pending_registration',      'Registrar\PendingRegistration@index');
Route::post('save_shift_reg',           'Registrar\ShiftRegistration@store');
Route::post('update_student_reg',       'Registrar\UpdateRegistration@update');
Route::post('new_student',              'Registrar\Registration@register_new_student');

Route::get('search_for_student/{name}', 'Search@student');
Route::post('search_student',           'Search@legacyid');
