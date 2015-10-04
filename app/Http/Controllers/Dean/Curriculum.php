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

class Curriculum extends Controller
{
    function manage_curriculum()
    {
        return view('dean.manage_curriculum');
    }
}
