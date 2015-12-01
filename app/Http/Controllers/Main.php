<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Party;
use App\Library\Api;
use App\Academicterm;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class Main extends Controller
{
    function index(Request $request)
    {
        if ( !Auth::guest()) {
            $user = Party::find(Auth::user()->id);

            return view('home', ['user' => $user]);
        } else
            return view('index');
    }

    function login(LoginRequest $request)
    {
        $username = $request->username;
        $password = $request->password;
        
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            $system     = Api::systemValue();
            $sy         = Academicterm::find($system->currentacademicterm);
            $session    = ['current_sy' => $sy->systart.'-'.$sy->syend,
                        'term' => $sy->term, 'phaseterm' => $system->phaseterm];
            Session::put($session);

            return redirect('/');
        }
        
        return back()->withInput()->with('message', htmlAlert('Authentication Failed'));
    }

    function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect('/');
    }
}
