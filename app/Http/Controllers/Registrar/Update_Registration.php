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
        $data['courses']    = Course::all();
        $data['majors']     = DB::table('tbl_major')->get();
        $data['religions']  = DB::table('tbl_religion')->get();

        $party              = Party::find($id);

        $data['id']         = $id;
        $data['firstname']  = $party->firstname;

        return view('registrar.update_student_reg', $data);
    }

}
