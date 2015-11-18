<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaveGrade extends Controller
{
    public function index(Request $request)
    {
        $grade  = $request->grade;
        $id     = $request->id;
        DB::table('tbl_studentgrade')->where('id', $id)->update(['id' => $grade]);

        return 'ok';
    }
}
