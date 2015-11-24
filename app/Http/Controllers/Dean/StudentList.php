<?php

namespace App\Http\Controllers\Dean;

use DB;
use App\Library\Api;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentList extends Controller
{
    public function index()
    {
        // check for phase and classallocation status
        // load the student that is enrolled in first sem
        // if current term is second term
        $system             = Api::systemValue();
        $data['isDisabled'] = ($system->phase != env('FIN') OR $system->classallocationstatus < 99) ? 'disabled' : '';
        $owner              = Api::getCollege();
        
        $data['students'] = DB::table('tbl_registration')
                            ->join('tbl_coursemajor', 'tbl_registration.coursemajor', '=', 'tbl_coursemajor.id')
                            ->join('tbl_course', 'tbl_coursemajor.course', '=' ,'tbl_course.id')
                            ->join('tbl_party', 'tbl_party.id', '=', 'tbl_registration.student')
                            ->where('tbl_course.college', $owner)
                            ->where('tbl_registration.status', '!=', 'G')
                            ->groupBy('student')->orderBy('legacyid', 'DESC')
                            ->select('firstname', 'lastname', 'description')->paginate(15);

        return view(Api::getView(), $data);
    }
}
