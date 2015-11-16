<?php

namespace App\Http\Controllers\Registrar;

use DB;
use App\Course;
use App\Library\Api;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Shift_Registration extends Controller
{
    public function index()
    {
        $data['courses']     = Course::all();
        $data['majors']     = DB::table('tbl_major')->get();
        $data['religions']  = DB::table('tbl_religion')->get();

        return view(Api::getView(), $data);
    }
}
