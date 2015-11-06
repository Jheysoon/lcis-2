<?php

namespace App;

use DB;
use App\Day_period;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table    = 'tbl_day';
    public $timestamps  = false;

    public static function getShortDay($cid)
    {
    	$c 		= Day_period::where('classallocation', $cid);
        $data   = [];

        if ($c->count() > 0) {
            $cc = $c->get();

            foreach ($cc as $dp) {
            	$day 	= self::find($dp->day);
                $data[] = $day->shortname;
            }

        }

        return implode(' / ', $data);
    }
}
