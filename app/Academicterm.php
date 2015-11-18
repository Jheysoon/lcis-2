<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Academicterm extends Model
{
    protected $table    = 'tbl_academicterm';
    public $timestamps  = false;

    public static function getShortTerm($id)
    {
        return DB::table('tbl_term')->where('id', $id)->first();
    }
}
