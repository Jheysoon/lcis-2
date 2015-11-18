<?php

namespace App\Http\Controllers\Registrar;

use App\Party;
use App\Library\Api;
use App\Registration;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Pending_Registration extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['registrations'] = Registration::pending()->paginate(15);

        return view(Api::getView(), $data);
    }

    public function show($registration_id)
    {
        // TODO: just show what change . previous value and current value
        // show the student id
        $registration       = Registration::find($registration_id);
        $party              = Party::find($registration->student);
        $data['firstname']  = $party->firstname;
        $data['lastname']   = $party->lastname;
        $data['middlename'] = $party->middlename;
        $data['id']         = $registration_id;

        return view('registrar.show_registration', $data);
    }
}
