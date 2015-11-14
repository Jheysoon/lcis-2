<?php

namespace App\Http\Controllers;

use DB;
use App\Party;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Search extends Controller
{
    public $results;

    function __construct()
    {
        $this->middleware('auth');
    }

    public function pending_student($name)
    {
        $this->results = DB::select("SELECT firstname, lastname, legacyid
                FROM tbl_party, tbl_registration
                WHERE (legacyid LIKE '%$name%'
                OR CONCAT(firstname, ' ', lastname) LIKE '%$name%')
                AND tbl_party.id = tbl_registration.student
                AND tbl_registration.status = 'P'
                ORDER BY lastname, firstname LIMIT 8");

        return $this->collection();
    }

    public function student($name)
    {
        $this->results = DB::select("SELECT firstname, lastname, legacyid
                FROM tbl_party, tbl_registration
                WHERE (legacyid LIKE '%$name%'
                OR CONCAT(firstname, ' ', lastname) LIKE '%$name%')
                AND tbl_party.id = tbl_registration.student
                ORDER BY lastname, firstname LIMIT 8");

        return $this->collection();
    }

    public function collection()
    {
        $data = [];

        foreach ($this->results as $result) {
            $data[] = ['value' => $result->legacyid, 'name' => $result->firstname.' '.$result->lastname];
        }

        return json_encode($data);
    }

    public function legacyid(Request $request)
    {
        $partys = Party::where('legacyid', $request->student);

        // think twice if this checking is needed
        // since the dropdown will show a reliable results
        if ($partys->count() > 0) {
            $party = $partys->first();

            return redirect("$request->redirect/$party->id");
        } else
            return back();
            // TODO: return back with error
    }
}
