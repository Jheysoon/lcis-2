<?php

namespace App\Http\Controllers\Edp;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Library\Api;
use App\Academicterm;

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
}
