<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Session;
use Validator;
use App\Party;
use App\Library\Api;
use App\User_access;
use App\Academicterm;

class Main extends Controller
{
    function index(Request $request)
    {
        if ($request->session()->has('uid')) {
            $user = Party::find($request->session()->get('uid'));
            
            return view('home', ['user' => $user,]);
        } else {
            return $this->login($request);
        }
    }

    function login($request)
    {
        $validation = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required'
            ]);

        if ($validation->fails()) {
            return view('index', ['error' => '', 'username' => '']);
        } else {
            $username   = $request->username;
            $password   = $request->password;
            $id         = $this->checkLogin($username, $password);

            if( is_numeric($id) ) {
                $system     = Api::systemValue();
                $current_sy = Academicterm::find($system->currentacademicterm);
                $data = ['uid'          => $id,
                         'username'     => $username,
                         'current_sy'   => $current_sy->systart.'-'.$current_sy->syend,
                         'term'         => $current_sy->term
                ];
                Session::put($data);

                return redirect('/');
            } else {
                $error = htmlAlert('Authentication Failed');

                return view('index', ['error' => $error]);
            }
        }
    }

    function checkLogin($username, $password)
    {
        $u = User_access::where('username', $username)->get();

        foreach ($u as $user) {
            if (password_verify($password, $user->password) AND $username == $user->username)
                return $user->partyid;
        }
        
        return false;
    }

    function logout()
    {
        Session::flush();

        return redirect('/');
    }
}
