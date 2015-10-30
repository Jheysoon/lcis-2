<?php

namespace App;

use DB;
use Auth;
use Session;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $table    = 'tbl_subject';
    public $timestamps  = false;

    public static function getSubject($owner, $system)
    {
    	if ($system->employeeid == Auth::user()->id) {
            $sql = DB::select("SELECT a.id as id, code, descriptivetitle, 
                        yearlevel, studentcount, section, coursemajor
                        FROM out_section a,tbl_subject b
                        WHERE a.subject = b.id AND (computersubject = 1 OR nstp = 1)
                        ORDER BY b.code ASC, coursemajor ASC, yearlevel ASC");
        } elseif($owner == 1) {
            $sql = DB::select("SELECT a.id as id, code, descriptivetitle, 
                        yearlevel, studentcount, section, coursemajor
                        FROM out_section a,tbl_subject b
                        WHERE a.subject = b.id AND owner = $owner AND (owner = 1 OR gesubject = 1) 
                        AND computersubject = 0 AND nstp = 0
                        ORDER BY b.code ASC, coursemajor ASC, yearlevel ASC");
        } else {
            $sql = DB::select("SELECT a.id as id, code, descriptivetitle, 
                        yearlevel, studentcount, section, coursemajor
                        FROM out_section a,tbl_subject b
                        WHERE a.subject = b.id AND owner = $owner 
                        AND computersubject = 0 AND gesubject = 0 AND nstp = 0
                        ORDER BY b.code ASC, coursemajor ASC, yearlevel ASC");
        }

        return $sql;
    }
}
