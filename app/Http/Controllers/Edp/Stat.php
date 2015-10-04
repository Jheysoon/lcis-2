<?php

namespace App\Http\Controllers\Edp;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Api;

class Stat extends Controller
{
    function index()
    {
        $api = new Api();
        return view('edp.stat', ['api' => $api]);
    }
}
