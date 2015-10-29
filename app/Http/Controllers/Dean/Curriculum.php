<?php

namespace App\Http\Controllers\Dean;

use DB;
use Session;
use Validator;
use App\Subject;
use App\Library\Api;
use App\Academicterm;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Curriculum extends Controller
{
    function manage_curriculum()
    {
        $c      = DB::table('tbl_coursemajor')->get();
        $acam   = Academicterm::all();
        $owner  = Api::getCollege();
        $cur    = DB::select("SELECT a.id as cur_id, a.description as cur_description, a.academicterm as cur_academicterm,
                b.description as c_description
                FROM tbl_curriculum a, tbl_course b, tbl_coursemajor c
                WHERE a.coursemajor = c.id AND b.id = c.course AND b.college = $owner");
        
        return view(Api::getView(), ['c' => $c, 'acam' => $acam, 'cur' => $cur]);
    }

    function view_curriculum($id)
    {
        $get_cur    = DB::select("SELECT `id`,code, descriptivetitle FROM tbl_subject
                    WHERE tbl_subject.id NOT IN (SELECT subject FROM tbl_curriculumdetail WHERE curriculum = '$id')
                    ORDER BY code ASC,descriptivetitle ASC");
        $cur_detail = DB::table('tbl_curriculumdetail')
                        ->where('curriculum', $id)
                        ->orderBy('yearlevel', 'ASC')
                        ->orderBy('term', 'ASC')
                        ->groupBy('yearlevel')
                        ->groupBy('term')->get();
        $cur        = DB::table('tbl_curriculum')->where('id', $id)->first();
        $cm         = DB::table('tbl_coursemajor')->where('id', $cur->coursemajor)->first();
        $c          = DB::table('tbl_course')->where('id', $cm->course)->first();
        $m          = '';

        if ($cm->major != 0) {
            $m      = DB::table('tbl_major')->where('id', $cm->major)->first();
            $major  = $m->description;
        }
        
        $course = $c->description.' '.$m;

        return view('dean.view_curriculum', compact('get_cur', 'cur_detail', 'cur', 'id', 'course'));
    }

    // delete a subject in curriculum
    function destroy($id)
    {
        DB::table('tbl_curriculumdetail')->where('id', $id)->delete();

        return back();
    }

    function insert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'subid'         => 'required',
            'yearlevel'     => 'required',
            'term'          => 'required'
            ]);

        if ($validation->fails()) {
            Session::flash('message', htmlAlert('All Fields Are Required'));
        } else {
            $data['curriculum'] = $request->cur_id;
            $data['subject']    = $request->subid;
            $data['yearlevel']  = $request->yearlevel;
            $data['term']       = $request->term;
            DB::table('curriculumdetail')->insert($data);
            Session::flash('message', htmlAlert('Successfully Added', 'success'));
        }

        return back();
    }

    function delete($id)
    {
        DB::table('tbl_curriculumdetail')->where('curriculum', $id)->delete();
        DB::table('tbl_curriculum')->where('id', $id)->delete();

        return back();
    }

    function copy(Request $request)
    {
        // academicterm must be not equal from the source
        $past_cur = DB::table('tbl_curriculum')->where('id', $request->curriculum_id)->first();

        if ($past_cur->academicterm == $request->sy_id) {
            Session::flash('message', htmlAlert('The Same Academicterm'));
        } else {
            $cur['coursemajor']     = $past_cur->coursemajor;
            $cur['academicterm']    = $past_cur->academicterm;
            $cur['yearlevel']       = $past_cur->yearlevel;
            $cur['description']     = $past_cur->description;
            $id                     = DB::table('tbl_curriculum')->insertGetId($cur);
            $past_detail            = DB::table('tbl_curriculumdetail')->where('curriculum', $request->curriculum_id)
                                    ->orderBy('yearlevel')->orderBy('term')->get();

            foreach ($past_detail as $detail) {
                $data['curriculum'] = $id;
                $data['subject']    = $detail->subject;
                $data['term']       = $detail->term;
                $data['yearlevel']  = $detail->yearlevel;
                DB::table('tbl_curriculumdetail')->insert($data);
            }

        }

        return back();
    }
}
