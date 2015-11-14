<?php

namespace App\Http\Controllers\Registrar;

use App\Library\Api;
use App\Registration;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Update_Registration extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['registrations'] = Registration::where('status', 'P')->paginate(15);

        return view(Api::getView(), $data);
    }

}
