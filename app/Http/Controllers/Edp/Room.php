<?php

namespace App\Http\Controllers\Edp;

use App\Day;
use App\Time;
use App\Classroom;
use App\Day_period;
use App\Library\Api;
use App\Academicterm;
use App\Http\Requests;
use App\Classallocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Room extends Controller
{
    public $system;

    public $table_day;

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

    public function index()
    {
        $data['system'] = $this->system;
        $data['acam']   = Academicterm::find($this->system->phaseterm);
        $data['rooms']  = Classroom::paginate(15);
        
        return view(Api::getView(), $data);
    }

    function room($roomId)
    {
        $data['system']     = $this->system;
        $room               = Classroom::findOrFail($roomId);
        $data['room_id']    = $roomId;
        $data['room_name']  = $room->legacycode;
        $data['location']   = $room->location;
        $data['days']       = Day::where('id', '!=', 8)->get();
        $data['times']      = Time::all();
        
        $data['table_day']  = $this->getSched($roomId);

        return view('edp.room_sched', $data);
    }

    function getSched($roomId)
    {
        $classes    = Classallocation::where('academicterm', $this->system->phaseterm)->get();
        $ctr        = 0;
        $day        = [ 0   => [], 1    => [], 
                        2   => [], 3   => [], 
                        4   => [], 5   => [], 
                        6   => []
                    ];
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($classes as $class) {

            if ($ctr > 11)
                $ctr = 0;

            $rooms = Day_period::where('classallocation', $class->id)->where('classroom', $roomId);

            if ($rooms->count() > 0) {
                $room = $rooms->get();

                foreach ($room as $sched) {

                    if ($sched->day == 8 OR $sched->from_time == 0 OR $sched->to_time == 0)
                        continue;

                    $from       = $sched->from_time;
                    $to         = $sched->to_time;
                    $span       = $to - $from;
                    $subject    = $class->getSubject->code;
                    $course     = isset($class->getCourse->shortname) ? $class->getCourse->shortname : '';

                    for ($i = $from; $i < $to; $i++) {

                        if ($i == $from) {
                            $day[$sched->day - 1][$i] = [
                                            'day'       => $days[$sched->day - 1],
                                            'rowspan'   => $span,
                                            'subject'   => $subject,
                                            'course'    => $course,
                                            'color'     => $this->color[$ctr]
                                        ];
                        } else {
                            $day[$sched->day - 1][$i] = ['day' => $days[$sched->day - 1]];
                        }

                    }
                        
                }

                $ctr++;
            } 

        } 

        $table_day['1'] = $day[0];
        $table_day['2'] = $day[1];
        $table_day['3'] = $day[2];
        $table_day['4'] = $day[3];
        $table_day['5'] = $day[4];
        $table_day['6'] = $day[5];
        $table_day['7'] = $day[6];

        return $table_day;
    }
}
