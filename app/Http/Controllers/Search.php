<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Search extends Controller
{
    public $result;

    function __construct()
    {
        $this->middleware('auth');
    }

    public function pending_student($name)
    {
        $this->result = DB::select("SELECT firstname, lastname, legacyid
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
        $this->result = DB::select("SELECT firstname, lastname, legacyid
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

        foreach ($this->result as $result) {
            $data[] = ['value' => $result->legacyid, 'name' => $result->firstname.' '.$result->lastname];
        }

        return json_encode($data);
    }
}
