<?php
namespace App;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class Api
{
    function user_menu($user)
    {
        return DB::select("SELECT name, link, c.desc as descrip FROM tbl_useroption a,tbl_option_header b,tbl_option c
                            WHERE a.userid = $user AND a.optionid = c.id AND a.header = b.id ORDER BY priors");
    }
}
