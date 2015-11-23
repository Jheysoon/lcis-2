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
Route::get('manage_section', 			'Dean\Manage_section@index');
Route::get('add_day_period_list',		'Dean\Add_day_period@dayPeriod_list');
Route::get('add_day_period/{id}', 		'Dean\Add_day_period@add_day_period');
Route::get('assign_instructor', 		'Dean\Assign_instructor@index');
Route::get('instructor_sched_list',     'Dean\Assign_instructor@instructor_sched_list');
Route::get('subject_list',              'Dean\Subject@index');
Route::get('subject/{id}',              'Dean\Subject@show');
Route::get('studentlist',               'Dean\StudentList@index');
Route::post('copy_curriculum',          'Dean\Curriculum@copy');
Route::post('curriculum/insert_subject','Dean\Curriculum@insert');
Route::post('save_instructor',          'Dean\Assign_instructor@save_instructor');

Route::get('stat',						'Edp\Stat@index');
Route::get('initClassallocation', 		'Edp\ClassAlloc@init');
Route::get('room_subj', 				'Edp\Room_subj@index');
Route::get('classRooms', 				'Edp\Room@index');
Route::get('room_sched/{id}', 			'Edp\Room@room');
Route::post('load_stat', 				'Edp\Stat@load_stat');
Route::post('studentcount', 			'Edp\Stat@studentcount');

Route::get('instructor/{id}',           'Instructor\Sched@show');
Route::get('class_list',                'Instructor\Instructor_Class@index');
Route::get('class/{id}',                'Instructor\Instructor_Class@show');
Route::post('save_grade',               'Instructor\SaveGrade@index');

Route::get('registration',              'Registrar\Registration@new_student');
Route::get('registration/{id}',         'Registrar\Pending_Registration@show');
Route::get('update_registration',       'Registrar\Update_Registration@index');
Route::get('update_registration/{id}',  'Registrar\Update_Registration@show');
Route::get('shift_student',             'Registrar\Shift_Registration@index');
Route::get('shift_student/{id}',        'Registrar\Shift_Registration@show');
Route::get('pending_registration',      'Registrar\Pending_Registration@index');
Route::post('save_shift_reg',           'Registrar\Shift_Registration@store');
Route::post('update_student_reg',       'Registrar\Update_Registration@update');
Route::post('new_student',              'Registrar\Registration@register_new_student');

Route::get('search_for_student/{name}', 'Search@student');
Route::post('search_student',           'Search@legacyid');
