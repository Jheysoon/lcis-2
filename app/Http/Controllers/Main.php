<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tbl_party;
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
            $username   = $request->username;
            $password   = $request->password;
            $id         = $this->checkLogin($username, $password);
            if( is_numeric($id) )
            {
                $request->session->put('uid', $id);
                return redirect();
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
        $u = Tbl_party::where('username', $username)->get();
        foreach ($u as $user)
        {
            if(password_verify($password, $user->password) AND $user->username == $username)
                return $user->id;
        }
        return FALSE;
    }
}
