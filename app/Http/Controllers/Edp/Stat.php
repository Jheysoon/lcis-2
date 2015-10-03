<?php

namespace App\Http\Controllers\Edp;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Stat extends Controller
{
    function index()
    {
        return view('edp.stat');
    }
}
