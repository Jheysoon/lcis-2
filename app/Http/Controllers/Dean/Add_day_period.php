<?php

namespace App\Http\Controllers\Dean;

use DB;
use Auth;
use Session;
use App\Day;
use App\Time;
use App\Subject;
use App\Day_period;
use App\Library\Api;
use App\Academicterm;
use App\Http\Requests;
use App\Classallocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Add_day_period extends Controller
{
    public $system;

    public $owner;

    public $error;

    function __construct()
    {
        $this->middleware('auth');
        $this->owner    = Api::getCollege();
        $this->system   = Api::systemValue();
    }

    function dayPeriod_list()
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
        } elseif ($this->system->employeeid == Auth::user()->id) {
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
                ->where('completedby', Auth::user()->id)->count();

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

    function add_day_period(Request $request, $id)
    {
        if ($request->has('day')) {
            $valid = $this->assign($request);

            if ($valid) {
                return redirect('add_day_period/'.$id);
            }

        } elseif ($request->has('submit')) {
            $this->error = htmlAlert('Please select a day');
        }

        $data['cid']    = $id;
        $data['error']  = $this->error;
        $data['cl']     = Classallocation::find($id);
        $data['days']   = Day::where('id', '!=', 8)->get();
        $data['times']  = Time::where('id', '!=', 12)->get();

        return view('dean.assigned_subj', $data);
    }

    function assign($request)
    {
        $day        = $request->day;
        $cid        = $request->class_id;
        $days       = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

        foreach ($day as $key => $value) {
            $start_time = $request->input('start_time'.$value);
            $end_time   = $request->input('end_time'.$value);

            // check if the user select the noon break time period
            if ($start_time != 11 AND $end_time != 13) {

                //end time period must be greater than the start time period
                if ($end_time > $start_time) {

                    // check if schedule overlaps
                    if ( ($start_time >= 1 AND $end_time <= 11) OR ($start_time >= 13 AND $end_time <= 28) ) {

                        // delete first the days and period before inserting
                        Day_period::where('classallocation', $cid)->delete();

                        $day_period = new Day_period;

                        $day_period->classallocation    = $cid;
                        $day_period->day                = $value;
                        $day_period->from_time          = $start_time;
                        $day_period->to_time            = $end_time;

                        $day_period->save();

                    } else {
                        $this->error = htmlAlert('Overlaps Noon Break in <strong>'.$days[$value - 1].'</strong>');

                        return false;
                    }

                } else {
                    $this->error = htmlAlert('End Time Period must be greater than Start Time in <strong>'.$days[$value - 1].'</strong>');

                    return false;
                }

            } else {

                if($start_time == 11 AND $end_time == 13)
                    $this->error = htmlAlert('Time Period must not in 12:00 pm - 1:00 pm in <strong>'.$days[$value - 1].'</strong>');
                elseif ($start_time == 11)
                    $this->error = htmlAlert('Start Time must not 12:00 pm in <strong>'.$days[$value - 1].'</strong>');
                elseif($end_time == 13)
                    $this->error = htmlAlert('End Time must not 1:00 pm in <strong>'.$days[$value - 1].'</strong>');

                return false;
            }

        }

        Session::flashdata('message', htmlAlert('Successfully added', 'success'));

        return true;
    }
}
