<?php

namespace App\Http\Controllers\Registrar;

use DB;
use Validator;
use App\Course;
use App\Library\Api;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewStudentRegRequest;

class Registration extends Controller
{
    public $system;

    function __construct()
    {
        $this->middleware('auth');
        $this->system = Api::systemValue();
    }

    public function new_student()
    {
        $data['courses']    = Course::all();
        $data['majors']     = DB::table('tbl_major')->get();
        $data['religions']  = DB::table('tbl_religion')->get();

        return view(Api::getView(), $data);

    }

    public function register_new_student(NewStudentRegRequest $request)
    {
        return back();
    }
}
