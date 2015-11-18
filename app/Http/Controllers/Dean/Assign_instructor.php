<?php

namespace App\Http\Controllers\Dean;

use DB;
use Auth;
use Session;
use App\Day;
use App\Time;
use App\Library\Api;
use App\Academicterm;
use App\Http\Requests;
use App\Classallocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Assign_instructor extends Controller
{
    public $system;

    public $owner;

    function __construct()
    {
        $this->middleware('auth');
        $this->system   = Api::systemValue();
        $this->owner    = Api::getCollege();
    }

    function index()
    {
        $status         = $this->system->classallocationstatus;
        $data['system'] = $this->system;

        if ($status == 99) {

            if (Auth::user()->id != $this->system->employeeid) {
                $data['college']    = DB::table('tbl_college')->where('id', $this->owner)->first();
            }

            $data['instruc'] = $this->instructors();
            $otherAcademic      = DB::table('tbl_academic')
                                ->where('college', '!=', '')
                                ->where('college', '!=', $this->owner)
                                ->select('id')->get();
            $otherAdminist      = DB::select("SELECT a.id as id FROM tbl_administration a,tbl_office b WHERE a.office = b.id AND b.college != ''");
            $data['otherInst']  = array_merge($otherAcademic, $otherAdminist);

            $data['acam']       = Academicterm::find(Session::get('phaseterm'));
            $data['sy']         = Academicterm::orderBy('systart')->orderBy('term')->get();
            $data['classes']    = Classallocation::getAlloc($this->owner, $this->system);

            $data['val'] = 'valid';

        } else {
            $data['val'] = 'not valid status';
        }

        return view(Api::getView(), $data);
    }

    function instructors()
    {
        $academic           = DB::table('tbl_academic')->where('college', $this->owner)->select('id')->get();
        $administration     = DB::select("SELECT a.id as id FROM tbl_administration a,tbl_office b
                            WHERE a.office = b.id AND b.college = $this->owner");

        return array_merge($academic, $administration);
    }

    function save_instructor(Request $request)
    {
        $acam       = Session::get('phaseterm');
        $instructor = $request->instructor;
        $class_id   = $request->cl_id;

        // no point if the instructor = 0
        if ($instructor != 0) {
            $time       = Time::getPeriod($class_id);
            $day        = Day::getShortDay($class_id);

            $conflict = Api::checkInstructor($instructor, $time, $day);

            if ($conflict == false) {
                $class = Classallocation::find($class_id);
                $class->instructor = $instructor;
                $class->save();

                if ($request->ajax == 0) {
                    Session::flashdata('message', htmlAlert('Successfully Assigned', 'success'));
                    return back();
                }

            } else {

                if ($request->ajax == 0){
                    Session::flashdata('message', htmlAlert('Conflict'));
                    return back();
                }
                else
                    echo 'conflict';
            }

        } else {

            if ($request->ajax == 0) {
                Session::flashdata('message', htmlAlert('Please Select a instructor'));
                return back();
            }
            else
                echo 'no';
        }
    }

    function instructor_sched_list()
    {
        $data['instruc'] = $this->instructors();
        $data['system'] = $this->system;

        return view('dean.instructor_list', $data);
    }
}
