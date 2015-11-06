<?php
namespace App\Library;

use App\Day_period;
use App\Classallocation;

/**
 * Handles the schedule table
 *
 */
class SchedCollection
{
    public $color   = array(
                        '#BA68C8','#0097A7',
                        '#F06292','#039BE5',
                        '#E57373','#00C853',
                        '#7986CB','#689F38',
                        '#9575CD','#43A047',
                        '#009688','#EF6C00'
                    );

    public $ctr     = 0;

    public $day     = [ 0   => [], 1   => [],
                        2   => [], 3   => [],
                        4   => [], 5   => [],
                        6   => []
                    ];

    public $collectioncollection;

    public $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    public function getSchedInstructor($instructor, $system)
    {
        $classes    = Classallocation::where('academicterm', $system->phaseterm)
                    ->where('instructor', $instructor)->get();

        foreach ($classes as $class) {
            if ($this->ctr > (count($this->color) - 1))
                $this->ctr = 0;

            $dayperiods = Day_period::where('classallocation', $class->id)->get();

            $this->getSched($dayperiods, $class);

            $this->ctr++;
        }

        return $this->returnCollection();

    }

    public function getSchedRoom($room, $system)
    {
        $classes    = Classallocation::where('academicterm', $system->phaseterm)->get();

        foreach ($classes as $class) {
            if ($this->ctr > (count($this->color) - 1))
                $this->ctr = 0;

                $dayperiods = Day_period::where('classallocation', $class->id)
                            ->where('classroom', $room)->get();

                $this->getSched($dayperiods, $class);

            $this->ctr++;
        }

        return $this->returnCollection();
    }

    function returnCollection()
    {
        $this->collection['1'] = $this->day[0];
        $this->collection['2'] = $this->day[1];
        $this->collection['3'] = $this->day[2];
        $this->collection['4'] = $this->day[3];
        $this->collection['5'] = $this->day[4];
        $this->collection['6'] = $this->day[5];
        $this->collection['7'] = $this->day[6];

        return $this->collection;
    }

    function getSched($dayperiods, $class)
    {
        // iterate through tbl_dayperiod
        foreach ($dayperiods as $sched) {

            // prevent a error to happened
            if ($sched->day == 8 OR $sched->from_time == 0 OR $sched->to_time == 0)
                continue;

            $from       = $sched->from_time;
            $to         = $sched->to_time;
            $span       = $to - $from;
            $subject    = $class->getSubject->code;
            $course     = isset($class->getCourse->shortname) ? $class->getCourse->shortname : '';

            for ($i = $from; $i < $to; $i++) {

                if ($i == $from) {
                    $this->day[$sched->day - 1][$i] = [
                                    'day'       => $this->days[$sched->day - 1],
                                    'rowspan'   => $span,
                                    'subject'   => $subject,
                                    'course'    => $course,
                                    'color'     => $this->color[$this->ctr]
                                ];
                } else {
                    $this->day[$sched->day - 1][$i] = ['day' => $this->days[$sched->day - 1]];
                }
            }
        }
    }
}
