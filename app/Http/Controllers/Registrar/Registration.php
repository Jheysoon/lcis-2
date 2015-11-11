<?php

namespace App\Http\Controllers\Registrar;

use DB;
use Validator;
use App\Course;
use App\Library\Api;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Registration extends Controller
{
    public $system;

    function __construct()
    {
        $this->middleware('auth');
        $this->system = Api::systemValue();
    }
    public function new_student(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'pass' => 'required'
            ]);
        if ( !$validator->fails()) {

        } else {
            $data['courses']    = Course::all();
            $data['majors']     = DB::table('tbl_major')->get();
            $data['religions']  = DB::table('tbl_religion')->get();
            return view(Api::getView(), $data);
        }

    }
}
