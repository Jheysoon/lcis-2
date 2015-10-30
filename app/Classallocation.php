<?php

namespace App;

use DB;
use Auth;
use Session;
use Illuminate\Database\Eloquent\Model;

class Classallocation extends Model
{
    protected $table    = 'tbl_classallocation';
    public $timestamps  = false;

    public static function getStudEnrol($cid, $acam)
    {
        
    }

    public static function getAlloc($owner, $system)
    {
    	if ($system->employeeid == Auth::user()->id) {
    		return DB::select("SELECT a.id as cid, coursemajor, descriptivetitle, code
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id AND academicterm = $system->phaseterm 
				AND (computersubject = 1 OR nstp = 1)
				ORDER BY b.code ASC, coursemajor ASC, a.id ASC");
    	} elseif ($owner == 1) {
    		return DB::select("SELECT a.id as cid, coursemajor, descriptivetitle, code
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id AND academicterm = $system->phaseterm 
				AND (owner = 1 OR gesubject = 1) AND computersubject = 0 AND nstp = 0
				ORDER BY b.code ASC, coursemajor ASC, a.id ASC");
    	} else {
    		return DB::select("SELECT a.id as cid, coursemajor, descriptivetitle, code
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id AND academicterm = $system->phaseterm 
				AND computersubject = 0 AND gesubject = 0 
				AND owner = $owner AND nstp = 0
				ORDER BY b.code ASC, coursemajor ASC, a.id ASC");
    	}
    }

    public function getSubject()
    {
                            // model  foreign_key              
        return $this->belongsTo('App\Subject', 'subject');
    }

    public static function getShortDay($cid)
    {
        $c      = DB::table('tbl_dayperiod')->where('classallocation', $cid);
        $data   = [];

        if ($c->count() > 0) {
            $cc = $c->get();
            /*  try to use namespace for day */
            foreach ($cc as $dp) {
                $day    = DB::table('tbl_day')->where('id', $dp->day)->first();
                $data[] = $day->shortname;
            }
            
        }

        return implode(' / ', $data);
    }

    public static function getPeriod($cid)
    {
        $c      = DB::table('tbl_dayperiod')->where('classallocation', $cid);
        $data   = [];

        if ($c->count() > 0) {
            $cc = $c->get();
            /*  try to use namespace for time */
            foreach ($cc as $per) {
                $day    = DB::table('tbl_time')->where('id', $per->day)->first();
                $data[] = $day->time;
            }
            
        }

        return implode(' / ', $data);
    }

    public static function getRooms($cid)
    {
        $c      = DB::table('tbl_dayperiod')->where('classallocation', $cid);
        $data   = [];

        if ($c->count() > 0) {
            $cc = $c->get();

            foreach ($cc as $rooms) {
                $room = DB::table('tbl_classroom')->where('id', $rooms->classroom)->first();
                $data[] = $room->legacycode;    
            }
            
        }

        return implode(' / ', $data);
    }
}
