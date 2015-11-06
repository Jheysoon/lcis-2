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

    public static function getAlloc($owner, $system)
    {
    	if ($system->employeeid == Auth::user()->id) {
    		return DB::select("SELECT a.id as cid, coursemajor, descriptivetitle, code, instructor
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id AND academicterm = $system->phaseterm
				AND (computersubject = 1 OR nstp = 1)
				ORDER BY b.code ASC, coursemajor ASC, a.id ASC");
    	} elseif ($owner == 1) {
    		return DB::select("SELECT a.id as cid, coursemajor, descriptivetitle, code, instructor
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id AND academicterm = $system->phaseterm
				AND (owner = 1 OR gesubject = 1) AND computersubject = 0 AND nstp = 0
				ORDER BY b.code ASC, coursemajor ASC, a.id ASC");
    	} else {
    		return DB::select("SELECT a.id as cid, coursemajor, descriptivetitle, code, instructor
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

    public function getCourse()
    {
        return $this->belongsTo('App\Course', 'coursemajor');
    }
}
