<?php

namespace App\Http\Controllers\Registrar;

use App\Library\Api;
use App\Registration;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Pending_Registration extends Controller
{
    public function index()
    {
        $data['registrations'] = Registration::pending()->paginate(15);

        return view(Api::getView(), $data);
    }
}
