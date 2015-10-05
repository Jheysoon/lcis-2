<?php

namespace App\Http\Controllers\Dean;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\Api;
use App\Option;
use App\Party;
use App\User_access;
use App\Academicterm;
use DB;

class Curriculum extends Controller
{
    function manage_curriculum()
    {
        $c      = DB::table('tbl_coursemajor')->get();
        $acam   = Academicterm::all();
        $o      = DB::table('tbl_academic')->where('id', Session::get('uid'));
        if($o->count() > 0)
        {
            $own = $i->first();
            $owner = $own->college;
        }
        else
        {
            $a      = DB::table('tbl_administration')->where('id', Session::get('uid'))->first();
            $ofs    = DB::table('tbl_office')->where('id', $a->office)->first();
            $owner  = $ofs->college;
        }
        $cur    = DB::select("SELECT a.id as cur_id, a.description as cur_description, a.academicterm as cur_academicterm,
                b.description as c_description
                FROM tbl_curriculum a, tbl_course b, tbl_coursemajor c
                WHERE a.coursemajor = c.id AND b.id = c.course AND b.college = $owner");
        return view('dean.manage_curriculum', ['c' => $c, 'acam' => $acam, 'cur' => $cur]);
    }
}
