<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User_access;
use Validator;
use DB;
use App\Api;
use App\Option;
use Session;
use App\Party;

class Main extends Controller
{
    function index(Request $request)
    {
        if($request->session()->has('uid'))
        {
            // TODO: get all menus
            $user = $request->session()->get('uid');
            return view('home', ['user' => $user,]);
        }
        else
        {
            return $this->login($request);
        }
    }

    function login($request)
    {
        $validation = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required'
            ]);

        if($validation->fails())
        {
            return view('index', ['error' => '', 'username' => '']);
        }
        else
        {
            $username   = $request->username;
            $password   = $request->password;
            $id         = $this->checkLogin($username, $password);
            if( is_numeric($id) )
            {
                $api        = new Api();
                $system     = $api->systemValue();
                $current_sy = $api->get_academicterm($system->currentacademicterm);
                $data = ['uid'          => $id,
                         'username'     => $username,
                         'current_sy'   => $current_sy->systart.'-'.$current_sy->syend,
                         'term'         => $current_sy->term
                ];
                Session::put($data);
                return redirect('/');
            }
            else
            {
                $error = '<div class="alert alert-danger text-center">Authentication Failed</div>';
                return view('index', ['error' => $error, 'username' => $username]);
            }
        }
    }

    function checkLogin($username, $password)
    {
        $u = User_access::where('username', $username)->get();
        foreach ($u as $user)
        {
            if(password_verify($password, $user->password) AND $username == $user->username)
                return $user->partyid;
        }
        return FALSE;
    }

    function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
