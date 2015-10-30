<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'tbl_day';

    public $timestamps = false;

    public static function getDayShort($id)
    {
    	$d = $this->find($id);
    }
}
