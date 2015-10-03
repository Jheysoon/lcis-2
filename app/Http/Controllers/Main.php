<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User_access;
use Validator;

class Main extends Controller
{
    function index(Request $request)
    {
        if($request->session()->has('uid'))
        {
            // TODO: get all menus
            return view('home');
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
            return view('index', ['error' => '']);
        }
        else
        {
            $username   = $request->username;
            $password   = $request->password;
            $id         = $this->checkLogin($username, $password);
            if( is_numeric($id) )
            {
                $request->session()->put('uid', $id);
                return redirect('/');
            }
            else
            {
                $error = '<div class="alert alert-danger text-center">Authenctication Failed</div>';
                return view('index', ['error' => $error]);
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

    function logout(Request $request)
    {
        $request->session()->forget('uid');
        return redirect('/');
    }
}
