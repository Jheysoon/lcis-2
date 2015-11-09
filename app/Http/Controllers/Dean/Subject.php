<?php

namespace App\Http\Controllers\Dean;

use App\Library\Api;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Subject as Subjects;
use App\Http\Controllers\Controller;

class Subject extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['subjects'] = Subjects::paginate(15);

        return view(Api::getView(), $data);
    }

    function show($id)
    {
        $subject_id =  Subjects::findOrFail($id);
        $owner      = Api::getCollege();

        if ($subject_id instanceof ModelNotFoundException)
            return view('errors.404');

        return view('dean.subject', ['subject' => $subject_id, 'owner' => $owner]);
    }
}
