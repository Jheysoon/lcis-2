<?php

namespace App\Http\Controllers\Instructor;

use App\Day;
use App\Time;
use App\Party;
use App\Day_period;
use App\Library\Api;
use App\Academicterm;
use App\Http\Requests;
use App\Classallocation;
use Illuminate\Http\Request;
use App\Library\SchedCollection;
use App\Http\Controllers\Controller;

class Sched extends Controller
{
    public $system;

    public $color = array(
                    '#BA68C8','#0097A7',
                    '#F06292','#039BE5',
                    '#E57373','#00C853',
                    '#7986CB','#689F38',
                    '#9575CD','#43A047',
                    '#009688','#EF6C00'
                );

    function __construct()
    {
        $this->middleware('auth');
        $this->system = Api::systemValue();
    }

    public function show($id)
    {
        $inst       = Party::find($id);

        if ( $inst instanceof ModelNotFoundException) {
            return view('errors.404');
        }

        $data['instructor'] = $inst;
        $data['classes']    = Classallocation::where('academicterm', $this->system->phaseterm)
                            ->where('instructor', $id);
        $data['days']       = Day::where('id', '!=', 8)->get();
        $data['times']      = Time::all();
        $schedCollection    = new SchedCollection;
        $schedCollection->getSchedInstructor($id, $this->system);
        $data['table_day']  = $schedCollection->collection;

        return view('instructor.sched', $data);
    }
}
