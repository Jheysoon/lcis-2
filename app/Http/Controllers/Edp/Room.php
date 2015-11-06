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
use App\Library\SchedCollection;
use App\Http\Controllers\Controller;

class Room extends Controller
{
    public $system;

    function __construct()
    {
        $this->middleware('auth');
        $this->system = Api::systemValue();
    }

    public function index()
    {
        $data['system'] = $this->system;
        $data['acam']   = Academicterm::findOrFail($this->system->phaseterm);
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
        $schedCollection    = new SchedCollection;
        $schedCollection->getSchedRoom($roomId, $this->system);
        $data['table_day']  = $schedCollection->collection;

        return view('edp.room_sched', $data);
    }
}
