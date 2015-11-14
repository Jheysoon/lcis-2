<?php

namespace App\Http\Controllers\Registrar;

use DB;
use App\Party;
use App\Course;
use App\Library\Api;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Update_Registration extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['courses']    = Course::all();
        $data['majors']     = DB::table('tbl_major')->get();
        $data['religions']  = DB::table('tbl_religion')->get();

        return view(Api::getView(), $data);
    }

    public function show($id)
    {
        // TODO: make this 3 query reusable
        $data['courses']            = Course::all();
        $data['majors']             = DB::table('tbl_major')->get();
        $data['religions']          = DB::table('tbl_religion')->get();

        $party                      = Party::find($id);
        //$student            = DB::table('tbl_student')->where('id', $id)->get();

        $data['id']                 = $id;
        $data['firstname']          = $party->firstname;
        $data['lastname']           = $party->lastname;
        $data['middlename']         = $party->middlename;
        $data['gender']             = $party->sex;
        $data['maritalstatus']      = $party->civilstatus;
        $data['religion_student']   = $party->religion;
        $data['mail_add']           = $party->address1;
        $data['contact']            = $party->mobilenumber;
        $data['emailadd']           = $party->emailaddress;

        return view('registrar.update_student_reg', $data);
    }

}
