<?php

namespace App;

use App\Day_period;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'tbl_classroom';
    public $timestamps = false;

    public static function getRooms($cid)
    {
        $c      = Day_period::where('classallocation', $cid);
        $data   = [];

        if ($c->count() > 0) {
            $cc = $c->get();

            foreach ($cc as $rooms) {
                $room 	= self::find($rooms->classroom);
                $data[] = $room->legacycode;    
            }
            
        }

        return implode(' / ', $data);
    }
}
