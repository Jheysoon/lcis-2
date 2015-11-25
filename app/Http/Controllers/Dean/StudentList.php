<?php

namespace App\Http\Controllers\Dean;

use DB;
use App\Library\Api;
use App\Academicterm;
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
        
        $academicterm = Academicterm::find($system->currentacademicterm);
        
        if ($academicterm->term == 2) {
            $acam               = $academicterm->id - 1;
            $data['students']   = DB::table('tbl_enrolment')
                                ->join('tbl_party', 'tbl_party.id', '=', 'tbl_enrolment.student')
                                ->join('tbl_registration', 'tbl_registration.student', '=', 'tbl_enrolment.student')
                                ->join('tbl_coursemajor', 'tbl_registration.coursemajor', '=', 'tbl_coursemajor.id')
                                ->join('tbl_course', 'tbl_course.id', '=', 'tbl_coursemajor.course')
                                ->where('tbl_course.college', $owner)
                                ->where('tbl_enrolment.academicterm', $acam)
                                ->orderBy('legacyid', 'DESC')
                                ->groupBy('tbl_enrolment.student')
                                ->select('firstname', 'lastname' ,'description')
                                ->paginate(15);
        
        } elseif ($academicterm->term == 1) {
            $acam               = $academicterm->id - 2;
            $data['students']   = DB::table('tbl_enrolment')
                                ->join('tbl_party', 'tbl_party.id', '=', 'tbl_enrolment.student')
                                ->join('tbl_registration', 'tbl_registration.student', '=', 'tbl_enrolment.student')
                                ->join('tbl_coursemajor', 'tbl_registration.coursemajor', '=', 'tbl_coursemajor.id')
                                ->join('tbl_course', 'tbl_course.id', '=', 'tbl_coursemajor.course')
                                ->where('tbl_course.college', $owner)
                                ->where('tbl_enrolment.academicterm', $acam)
                                ->orderBy('legacyid', 'DESC')
                                ->groupBy('tbl_enrolment.student')
                                ->select('firstname', 'lastname' ,'description')
                                ->paginate(15);
        }

        return view(Api::getView(), $data);
    }
}
