<?php

namespace App\Http\Controllers\Registrar;

use DB;
use App\Party;
use App\Course;
use App\Library\Api;
use App\Registration;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Shift_Registration extends Controller
{
    public function index()
    {
        $data['courses']    = Course::all();
        $data['majors']     = DB::table('tbl_major')->get();
        $data['religions']  = DB::table('tbl_religion')->get();
        $data['shift']      = $data['update'] = 'yes it is';

        return view(Api::getView(), $data);
    }

    public function show($id)
    {
        $party                  = Party::find($id);
        $registration           = Registration::student($id)->latest()->first();
        $coursemajor            = DB::table('tbl_coursemajor')->where('id', $registration->coursemajor)->first();
        $data['courses']        = Course::all();
        $data['majors']         = DB::table('tbl_major')->get();
        $data['religions']      = DB::table('tbl_religion')->get();

        $data['firstname']      = $party->firstname;
        $data['lastname']       = $party->lastname;
        $data['middlename']     = $party->middlename;
        $data['course_student'] = $coursemajor->course;
        $data['major_student']  = $coursemajor->major;
        $data['shift']          = $data['update'] = 'yes it is';

        return view('registrar.shift_registration', $data);
    }
}
