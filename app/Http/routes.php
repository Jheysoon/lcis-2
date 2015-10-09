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

Route::any('/', 'Main@index');
Route::get('/logout', 'Main@logout');
Route::get('/stat','Edp\Stat@index');

Route::get('manage_curriculum', 'Dean\Curriculum@manage_curriculum');
Route::get('view_curriculum/{id}', 'Dean\Curriculum@view_curriculum');
Route::get('delete_subject_cur/{id}', 'Dean\Curriculum@destroy');
Route::post('curriculum/insert_subject', 'Dean\Curriculum@insert');
Route::get('delete_cur/{id}', 'Dean\Curriculum@delete');
Route::post('copy_curriculum', 'Dean\Curriculum@copy');

Route::post('load_stat', 'Edp\Stat@load_stat');
