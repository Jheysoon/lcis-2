<?php

namespace App\Http\Controllers\Edp;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Library\Api;

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
}
