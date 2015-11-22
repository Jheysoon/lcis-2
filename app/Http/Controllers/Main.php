<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Party;
use App\Library\Api;
use App\Academicterm;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Main extends Controller
{
    function index(Request $request)
    {
        if ( !Auth::guest()) {
            $user = Party::find(Auth::user()->id);

            return view('home', ['user' => $user]);
        }

        return $this->login($request);
    }

    function login($request)
    {
        $error = '';

        if ( $request->has('username') AND $request->has('password')) {
            $username = $request->username;
            $password = $request->password;

            if (Auth::attempt(['username' => $username, 'password' => $password])) {
                $system = Api::systemValue();
                $sy     = Academicterm::find($system->currentacademicterm);
                $ses    = ['current_sy' => $sy->systart.'-'.$sy->syend,
                        'term' => $sy->term, 'phaseterm' => $system->phaseterm];
                Session::put($ses);

                return redirect('/');
            }

            $error = htmlAlert('Authentication Failed');
        }

        return view('index', ['error' => $error]);
    }

    function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect('/');
    }
}
