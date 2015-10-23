<?php
namespace App\Library;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;

class Api
{
    public static function getView()
    {
        $route  = ltrim($_SERVER['REQUEST_URI'], '/');
        $op     = DB::table('tbl_option')->where('link', $route);

        if ($op->count() > 0) {
            $option = $op->first();
            $isUserMenu = DB::table('tbl_useroption')
                        ->where('userid', Session::get('uid'))
                        ->where('optionid', $option->id)
                        ->count();

            if ($isUserMenu > 0) {
                $file = str_replace('/', '.', $option->file);

                // check if the view file exists
                if (view()->exist($file)) {
                    return $file;
                } else {
                    return view('errors.404');
                }

            } else {
                return view('errors.unathorized');
            }
            
        } else {
            return view('error.404');
        }

    }

    public static function systemValue()
    {
        return DB::table('tbl_systemvalues')->first();
    }

    public static function getCollege()
    {
        $o      = DB::table('tbl_academic')->where('id', Session::get('uid'));

        if ($o->count() > 0) {
            $own = $i->first();

            return $own->college;
        } else {
            $a      = DB::table('tbl_administration')->where('id', Session::get('uid'))->first();
            $ofs    = DB::table('tbl_office')->where('id', $a->office)->first();

            return $ofs->college;
        }
    }

    public static function yearLevel($partyid)
    {
        $system     = $this->systemValue();
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
						AND enrolment = {$val['id']}");

                foreach ($stud as $stud_subj) {
                    $stu = DB::select("SELECT * FROM tbl_subject
						WHERE id = (SELECT subject FROM tbl_classallocation WHERE id = {$stud_subj['classallocation']})");

                    $cur_detail = DB::table('tbl_curriculumdetail')->where('curriculum', $cur_id)->where('subject', $stu[0]->id);

                    if ($cur_detail->count() > 0) {
                        $student_units += $stu[0]->units;
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

    // 1:00-3:00 / 2:00-5:00

	//$from = 1:00,	$from_compare 	= 2:00
	//$to 	= 3:00,	$to_compare 	= 5:00
    public static function intersectCheck($from, $from_compare, $to, $to_compare)
	{
        if ($from == $from_compare AND $to == $to_compare)
            return true;

        $from 			= strtotime($from);
        $from_compare 	= strtotime($from_compare);
        $to 			= strtotime($to);
        $to_compare 	= strtotime($to_compare);
        $intersect 		= min($to, $to_compare) - max($from, $from_compare);

        if ( $intersect < 0 ) $intersect = 0;
        $overlap = $intersect / 3600;
        if ( $overlap <= 0 ):
            // There are no time conflicts
            return false;
            else:
            // There is a time conflict
            // echo '<p>There is a time conflict where the times overlap by ' , $overlap , ' hours.</p>';
            return true;
        endif;
    }
}
