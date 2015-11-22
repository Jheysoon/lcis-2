<?php

namespace App\Http\Controllers\Edp;

use DB;
use App\Library\Api;
use App\Http\Requests;
use App\Classallocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomSubj extends Controller
{
    public $system;

    function __construct()
    {
        $this->middleware('auth');
        $this->system = Api::systemValue();
    }

    public function index()
    {
        $status = $this->system->classallocationstatus;
        $data['system'] = $this->system;

        if ($status == 4) {
            $c = DB::table('tbl_completion')
                ->where('academicterm', $this->system->phaseterm)
                ->where('stage', 4)->where('status', 'O')->count();

            if ($c == env('COLLEGE_COUNT')) {
                $data['val'] = 'ok';
                $data['class'] = Classallocation::where('academicterm', $this->system->phaseterm)->get();
            } else {
                $data['colleges'] = DB::table('tbl_college')->where('id', '!=', 6)->get();
                $data['val'] = 'you cannot continue';
            }

        } elseif($status == 3) {
            $data['colleges'] = DB::table('tbl_college')->where('id', '!=', 6)->get();
            $data['val'] = 'you cannot continue';
        } else {
            $data['colleges'] = DB::table('tbl_college')->where('id', '!=', 6)->get();
            $data['val'] = 'not yet';
        }

        return view(Api::getView(), $data);
    }
}
