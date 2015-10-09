<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Classallocation extends Model
{
    protected $table    = 'tbl_classallocation';
    public $timestamps  = false;

    public static function getStudEnrol($cid, $acam)
    {
        
    }
}
