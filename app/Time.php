<?php

namespace App;

use App\Day_period;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table    = 'tbl_time';
    public $timestamps  = false;

    public static function getPeriod($cid)
    {
        $c      = Day_period::where('classallocation', $cid);
        $data   = [];

        if ($c->count() > 0) {
            $cc = $c->get();

            foreach ($cc as $per) {
                $times    	= self::find($per->day);
                $data[] 	= $times->time;
            }

        }

        return implode(' / ', $data);
    }
}
