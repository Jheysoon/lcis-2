<?php

namespace App\Http\Controllers\Dean;

use App\Library\Api;
use App\Academicterm;
use App\Registration;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Evaluation extends Controller
{
    public $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function index($id)
    {
        $data['system']         = $system   = Api::systemValue();
        $data['academicterm']   = Academicterm::find($system->phaseterm);
        $data['registration']   = Registration::student($id)->latest()->first();
        $data['message']        = '';
        $data['yearlevel']      = Api::yearLevel($id, false);
        $data['coursemajor']    = Api::getCourseMajor($data['registration']->coursemajor);
        $data['id']             = $id;
        
        return view('dean.preEnroll', $data);
    }
    
    public function evaluate()
    {
        $ctr            = $this->request->count;
        $coursemajor    = $this->request->coursemajor;
        $unit           = 0;
        $ctr2           = 1;
        $nstp           = false;
        $subCount       = 0;
    }
}
