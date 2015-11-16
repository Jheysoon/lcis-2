<?php

namespace App\Http\Controllers\Registrar;

use DB;
use Session;
use App\Party;
use App\Course;
use App\Library\Api;
use App\Registration;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Request\UpdateRegistrationRequest;

class Update_Registration extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $common                     = $this->commonQuery();
        $data['courses']            = $common['course'];
        $data['majors']             = $common['majors'];
        $data['religions']          = $common['religions'];

        return view(Api::getView(), $data);
    }

    public function show($id)
    {
        $common                     = $this->commonQuery();
        $data['courses']            = $common['course'];
        $data['majors']             = $common['majors'];
        $data['religions']          = $common['religions'];

        $party                      = Party::find($id);
        //$student            = DB::table('tbl_student')->where('id', $id)->get();

        // get the latest registration
        $registration               = Registration::student($id)->latest()->first();
        $coursemajor                = DB::table('tbl_coursemajor')->where('id', $registration->coursemajor)->first();

        $data['id']                 = $id;
        $data['firstname']          = $party->firstname;
        $data['lastname']           = $party->lastname;
        $data['middlename']         = $party->middlename;
        $data['gender']             = $party->sex;
        $data['maritalstatus']      = $party->civilstatus;
        $data['religion_student']   = $party->religion;
        $data['mail_add']           = $party->address1;
        $data['contact']            = $party->mobilenumber;
        $data['emailadd']           = $party->emailaddress;
        $data['update']             = 'yes this is a update';

        return view('registrar.update_student_reg', $data);
    }

    function commonQuery()
    {
        return [
            'course'    => Course::all(),
            'majors'    => DB::table('tbl_major')->get(),
            'religions' => DB::table('tbl_religion')->get()
        ];
    }

    public function update(UpdateRegistrationRequest $request)
    {
        $party                  = Party::find($request->student);
        $party->firstname       = $request->firstname;
        $party->lastname        = $request->lastname;
        $party->middlename      = $request->middlename;
        $party->emailaddres     = $request->emailadd;
        $party->sex             = $request->gender;
        $party->mobilenumber    = $request->contact;
        $party->address1        = $request->mailing_add;

        Session::put('message', htmlAlert('Successfully Updated', 'success'));
        return redirect('update_registration');
    }

}
