<?php

namespace App\Http\Controllers\Dean;

use DB;
use Session;
use App\Subject;
use App\Library\Api;
use App\Academicterm;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Classallocation;
use App\Http\Controllers\Controller;

class Manage_section extends Controller
{
    public $system;
    
    public $owner;

    function __construct()
    {
        $this->system   = Api::systemValue();
        $this->owner    = Api::getCollege();
    }

    public function index()
    {
        $data['system'] = $this->system;
        $data['count']  = DB::table('tbl_completion')
                        ->where('academicterm', $this->system->phaseterm)
                        ->where('stage', 2)
                        ->where('completedby', Session::get('uid'))
                        ->count();
        $data['$sql'] = Subject::getSubject($this->owner, $this->system);

        return view('dean.manage_section', $data);
    }

    function dayPeriod()
    {
        $data['owner'] = $this->owner;
        $data['system'] = $this->system;

        if ($this->owner == 1) {
            $subject_owner = Subject::where('nstp', 0)
                            ->where(function ($query) {
                                $query->where('owner', 1)->orWhere('gessubject', 1);
                            })
                            ->where('computersubject', 0)
                            ->where('nstp', 0)->get();
        } elseif ($this->system->employeeid == Session::get('uid')) {
            $subject_owner = Subject::where('gesubject', 0)
                            ->where(function ($query) {
                                $query->where('computersubject', 1)
                                ->orWhere('nstp', 1);
                            })->get();
        } else {
            $subject_owner = Subject::where('nstp', 0)
                            ->where('owner', $this->owner)
                            ->where('computersubject', 0)
                            ->where('gesubject', 0)->get();
        }

        $data['subject'] = $subject_owner;

        if ($this->system->classallocationstatus != 3) {
            $data['val'] = 'class not init';
        } else {
            $s = DB::table('tbl_completion')->where('stage', 4)
                ->where('completedby', Session::get('uid'))->count();

            if ($s > 1)
                $data['val'] = 'attested';
            else
                $data['sub'] = Classallocation::getAlloc($this->owner, $this->system);
            
        }

        $t              = Academicterm::find($this->system->phaseterm);
        $term           = DB::table('tbl_term')->where('id', $t->term)->first();
        $data['acam']   = $t->systart.' - '.$t->syend.' Term: '.$term->shortname;

        
        return view('dean.add_day_period', $data);
    }
}
