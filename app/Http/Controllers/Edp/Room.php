<?php

namespace App\Http\Controllers\Edp;

use App\Classroom;
use App\Library\Api;
use App\Academicterm;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Room extends Controller
{
    public $system;

    function __construct()
    {
        $this->middleware('auth');
        $this->system = Api::systemValue();
    }

    public function index()
    {
        $data['system'] = $this->system;
        $data['acam']   = Academicterm::find($this->system->phaseterm);
        $data['rooms']  = Classroom::paginate(15);
        
        return view(Api::getView(), $data);
    }
}
