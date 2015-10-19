<?php

namespace App\Http\Controllers\Edp;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use DB;
use App\Library\Api;

class ClassAlloc extends Controller
{
    public $system;

    function __construct()
    {
    	$this->system = Api::systemValue();
    }

    function init()
    {
    	$data['system'] = $this->system;
    	$data['c']		= DB::table('tbl_completion')->where('stage', 2)
							->where('academicterm', $system->phaseterm)
							->where('status', 'O');

    	return view('edp.initClass', $data);
    }
}
