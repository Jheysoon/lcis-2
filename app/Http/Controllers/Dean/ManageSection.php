<?php

namespace App\Http\Controllers\Dean;

use DB;
use Session;
use App\Subject;
use App\Library\Api;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageSection extends Controller
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
}
