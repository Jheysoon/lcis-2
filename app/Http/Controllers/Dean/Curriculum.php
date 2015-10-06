<?php

namespace App\Http\Controllers\Dean;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\Library\Api;
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
        $owner  = Api::get_college();
        $cur    = DB::select("SELECT a.id as cur_id, a.description as cur_description, a.academicterm as cur_academicterm,
                b.description as c_description
                FROM tbl_curriculum a, tbl_course b, tbl_coursemajor c
                WHERE a.coursemajor = c.id AND b.id = c.course AND b.college = $owner");
        return view('dean.manage_curriculum', ['c' => $c, 'acam' => $acam, 'cur' => $cur]);
    }

    function view_curriculum($id)
    {
        $get_cur    = DB::select("SELECT `id`,code, descriptivetitle FROM tbl_subject
                    WHERE tbl_subject.id NOT IN (SELECT subject FROM tbl_curriculumdetail WHERE curriculum = '$id')
                    ORDER BY code ASC,descriptivetitle ASC");
        $cur_detail = DB::table('tbl_curriculumdetail')
                        ->where('curriculum', $id)
                        ->orderBy('yearlevel', 'ASC')
                        ->orderBy('term', 'ASC')->get();
        $cur        = DB::table('tbl_curriculum')->where('id', $id)->first();
        return view('dean.view_curriculum', compact('get_cur', 'cur_detail', 'cur', 'id'));
    }
}
