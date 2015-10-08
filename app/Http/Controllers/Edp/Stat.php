<?php

namespace App\Http\Controllers\Edp;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Library\Api;

class Stat extends Controller
{
    function index()
    {
        $nxt = Api::systemValue();
        return view('edp.stat', ['nxt' => $nxt]);
    }
}
