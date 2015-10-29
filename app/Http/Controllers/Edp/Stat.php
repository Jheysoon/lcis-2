<?php

namespace App\Http\Controllers\Edp;

use App\Library\Api;
use App\Academicterm;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Stat extends Controller
{
    public $system_value;

    function __construct()
    {
        $this->system_value = Api::systemValue();
    }

    function index()
    {
        return view('edp.stat', ['nxt' => $this->system_value]);
    }

    function load_stat()
    {
        if ($this->system_value->phase == env('FIN')) {
            echo view('edp.ajax.student_count', ['system' => $this->system]);
        } else {
            echo 'Not final';
        }
    }

    function studentcount(Request $request)
    {
        $yearlevel  = $request->yearlevel;
        $count      = $request->count;
        //truncate table before inserting
        DB::table('out_studentcount')->truncate();

        foreach ($request->coursemajor as $key => $value) {
            $data                   = array();
            $data['course']         = $value;
            $data['yearlevel']      = $year_level[$key];
            $data['studentcount']   = $count[$key];
            $data['academicterm']   = $acam;
            DB::table('out_studentcount')->insert($data);
        }

        $this->out_section();
    }

    function out_section()
    {
        DB::table('out_section')->truncate();
        $tt     = Academicterm::find($this->system->phaseterm);
        $term   = $tt->term;
        $acamd  = Academicterm::where('systart', '<=', $tt->systart)
                ->orderBy('systart', 'DESC')->orderBy('term', 'ASC')->get();
    }
}
