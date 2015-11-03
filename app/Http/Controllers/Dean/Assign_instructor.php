<?php

namespace App\Http\Controllers\Dean;

use DB;
use Auth;
use Session;
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
                $academic           = DB::table('tbl_academic')->where('college', $this->owner)->select('id')->get();
                $administration     = DB::select("SELECT a.id as id FROM tbl_administration a,tbl_office b WHERE a.office = b.id AND b.college = $this->owner");
                $data['instruc']    = array_merge($academic, $administration);

                $otherAcademic      = DB::table('tbl_academic')
                                    ->where('college', '!=', '')
                                    ->where('college', '!=', $this->owner)
                                    ->select('id')->get();
                $otherAdminist      = DB::select("SELECT a.id as id FROM tbl_administration a,tbl_office b WHERE a.office = b.id AND b.college != ''");
                $data['otherInst']  = array_merge($otherAcademic, $otherAdminist);
            } else {
                $data['instruc'] = '';
                $data['college'] = '';
            }

            $data['acam']       = Academicterm::find(Session::get('phaseterm'));
            $data['sy']         = DB::table('tbl_academicterm')->orderBy('systart,term')->get();
            $data['classes']    = Classallocation::getAlloc($this->owner, $this->system);

            $data['val'] = 'valid';

        } else {
            $data['val'] = 'not valid status';
        }

        return view(Api::getView(), $data);
    }
}
