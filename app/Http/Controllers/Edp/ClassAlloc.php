<?php

namespace App\Http\Controllers\Edp;

use DB;
use Session;
use App\Library\Api;
use App\Http\Requests;
use App\Classallocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassAlloc extends Controller
{
    public $system;

    function __construct()
    {
    	$this->system = Api::systemValue();
        $this->middleware('auth');
    }

    function init()
    {
    	$data['val'] = '';
    	if ($this->system->phaseterm == env('FIN')) {
            $stat = $this->system->classallocationstatus;

    		if ($stat == 2 OR $stat == 1) {
    			$c		= DB::table('tbl_completion')->where('stage', 2)
							->where('academicterm', $system->phaseterm)
							->where('status', 'O');

    			if ($c == env('COLLEGE_COUNT')) {
    				// update the systemvalues
					DB::table('tbl_systemvalues')->update(['classallocationstatus' => 3]);
					// delete classallocation for this phaseterm
					Classallocation::where('academicterm', $system->phaseterm)->delete();
					$sec = DB::table('out_section')->get();

					foreach ($sec as $section) {

						// if the section is zero it will not satisfy this condition
						for ($i = 1; $i <= $section->section; $i++) {
                            $class                  = new Classallocation;
                            $class->academicterm    = $section->academicterm;
                            $class->coursemajor     = $section->coursemajor;
                            $class->subject         = $section->subject;
                            $class->instructor      = 0;
                            $class->reserved        = 0;
                            $class->enrolled        = 0;
                            $class->save();
						}
					}

					$data['val'] = 'OK';
    			} else
    				$data['val'] = 'college count';

    		} else
    			$data['val'] = 'cannot run';

    	} else
    		$data['val'] = 'cannot run in this phase';

    	return view('edp.initClass', $data);
    }
}
