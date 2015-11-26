<?php
namespace App\Library;

use DB;
use Auth;
use Session;
use App\Day;
use App\Time;
use App\Day_period;
use App\Http\Requests;
use Illuminate\Http\Request;

class Api
{
    public static function getView()
    {
        $route  = ltrim($_SERVER['REQUEST_URI'], '/');

        if (strpos($route, '?')) {
            $r      = explode('?', $route);
            $route  = $r[0];
        }

        $op     = DB::table('tbl_option')->where('link', $route);

        if ($op->count() > 0) {
            $option = $op->first();
            $isUserMenu = DB::table('tbl_useroption')
                        ->where('userid', Auth::user()->id)
                        ->where('optionid', $option->id)
                        ->count();

            if ($isUserMenu > 0) {
                $file = str_replace('/', '.', $option->file);

                // check if the view file exists
                if (view()->exists($file))
                    return $file;
                else
                    return view('errors.404');

            } else
                return view('errors.unathorized');

        } else
            return view('errors.404');

    }

    public static function systemValue()
    {
        return DB::table('tbl_systemvalues')->first();
    }

    public static function getCollege()
    {
        $o      = DB::table('tbl_academic')->where('id', Auth::user()->id);

        if ($o->count() > 0) {
            $own = $o->first();

            return $own->college;
        } else {
            $a      = DB::table('tbl_administration')->where('id', Auth::user()->id)->first();
            $ofs    = DB::table('tbl_office')->where('id', $a->office)->first();

            return $ofs->college;
        }
    }

    public static function yearLevel($partyid)
    {
        $system     = self::systemValue();
        $sy         = $system->nextacademicterm;
        $tolerance  = (int) $system->cutoffpercentage;
        $cur_id     = 0;
        $cur        = DB::table('tbl_registration')->where('student', $partyid);

        if ($cur->count() > 0) {
            $c = $cur->first();
            $cur_id = $c->curriculum;
        } else {
            $data['comment'] = 'not found tbl_registration';
            $data['student'] = $partyid;
            DB::table('out_exception')->insert($data);

            return 'Does not have a registration';
        }

        $acam_tru = DB::table('tbl_registration')->where('student', $partyid)
                    ->where(function ($query)
                    {
                        $query->whereNull('academicterm')->orWhere('academicterm', 0);
                    })->count();

        if ($acam_tru > 0) {
            $acam['comment'] = 'no valid academicterm tbl_registration';
            $acam['student'] = $partyid;
            DB::table('out_exception')->insert($acam);

            return 'error';
        }

        if ($cur_id != 0) {
            $units 			= 0;
			$sum_units 		= array(0 => 0, 1 => 0, 2 => 0, 3 => 0);
			$student_units 	= 0;

            $c = DB::table('tbl_year_units')->where('curriculum', $cur_id)->count();

            if ($c < 1) {
                $f['comment'] = 'not found tbl_curriculum';
                $f['student'] = $partyid;
                DB::table('out_exception')->insert($f);

                return 'Error';
            }

            for ( $i = 1; $i <= 4; $i++ ) {
                // get the total units by yearlevel
				// add validation if the curriculum does not exist in tbl_year_units
                $u                  = DB::table('tbl_year_units')->where('yearlevel', $i)->where('curriculum', $cur_id)->first();
                $units              += $u->totalunits;
                $sum_units[$i - 1]  = $units;
            }

            $enrol = DB::table('tbl_enrolment')->where('student', $partyid)->get();

            foreach ($enrol as $val) {
                $stud = DB::select("SELECT * FROM tbl_studentgrade
					WHERE (semgrade <= 21 OR semgrade = 44
						OR reexamgrade <= 21)
						AND enrolment = $val->id");

                foreach ($stud as $stud_subj) {
                    $stu    = DB::select("SELECT a.id as id, units FROM tbl_subject a, tbl_classallocation b
						        WHERE a.id = b.subject and b.id = $stud_subj->classallocation");
                                
                    foreach ($stu as $key) {
                        $subject    = $key->id;
                        $sub_units  = $key->units;
                    }
                        
                    $cur_detail = DB::table('tbl_curriculumdetail')->where('curriculum', $cur_id)->where('subject', $subject);

                    if ($cur_detail->count() > 0) {
                        $student_units += $sub_units;
                    }

                }

            }

            $h['comment']       = 'OK';
            $h['student']       = $partyid;
            $h['student_units'] = $student_units;
            $h['totalunits']    = $units;
            DB::table('out_exception')->insert($h);

            for ( $q = 0; $q <= 3 ; $q++ ) {
				$m_units = (int) ($sum_units[$q] * ($tolerance / 100));

				if ($student_units <= $sum_units[$q]) {

					if ($student_units >= $m_units AND $student_units <= $sum_units[$q]) {
						$u = $q + 2;
						if($u >= 4)
							return 4;
						else
							return $u;
					}

					return $q + 1;
				}

			}

			return 'end if function';
        } else {
            $b['comment'] = 'no curriculum tbl_registration';
			$b['student'] = $partyid;
            DB::table('out_exception')->insert($b);

			return 'Curriculum not fount';
        }

    }

    public static function getCourseMajor($cid)
    {
        if ($cid == 0)
            return;

        $cm     = DB::table('tbl_coursemajor')->where('id', $cid)->first();
        $course = DB::table('tbl_course')->where('id', $cm->course)->first();
        $major  = '';

        if($cm->major != 0) {
            $major = DB::table('tbl_major')->where('id', $cm->major)->first();
            $major = '('.$major->description.')';
        }

        return $course->description.' '.$major;
    }

    public static function checkInstructor($instructor, $time, $day)
    {
        $instructor_sched   = Day_period::getInstructorsSched($instructor);
        $subject_time       = explode(' / ', $time);
        $subject_day        = explode(' / ', $day);

        foreach ($instructor_sched as $sched) {

            if ( !in_array('TBA', $subject_day)) {
                $inst_day = Day::find($sched->day);

                if ( !in_array($inst_day, $subject_day)) {
                    $from   = Time::find($sched->from_time);
                    $to     = Time::find($sched->to_time);

                    foreach ($subject_time as $key) {
                        $keys       = explode('-', $key);
                        $isConflict = intersectCheck($from->time, $keys[0], $to->time, $keys[1]);

                        if ($isConflict)
                            return true;
                    }
                }
            }
        }
        return false;
    }
}
