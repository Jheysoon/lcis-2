<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;

class Main extends Controller
{
    function index(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required'
            ]);

        if($validation->fails())
        {
            return view('index');
        }
        else
        {
            $username = $request->username;
            $password = $request->password;
        }

    }
}
