<?php

namespace App\Http\Controllers\Dean;

use App\Library\Api;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Add_day_period extends Controller
{
    public $system;

    public $owner;

    function __construct()
    {
        $this->middleware('auth');
        $this->owner    = Api::getCollege();
        $this->system   = Api::systemValue();
    }
}
