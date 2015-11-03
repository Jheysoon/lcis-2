<?php

namespace App;

use Session;
use App\Classallocation;
use Illuminate\Database\Eloquent\Model;

class Day_period extends Model
{
    protected $table = 'tbl_dayperiod';
    public $timestamps = false;

    public static function getInstructorsSched($id)
    {
    	$sy 		= Session::get('phaseterm');
    	$classes	= Classallocation::where('academicterm', $sy)->where('instructor', $id)->get();
    	$data 		= [];

    	foreach ($classes as $class) {
    		$d = self::where('classallocation', $class->id)->get();

    		foreach ($d as $dd) {
    			$data[] = $dd;
    		}
    	}

    	return $data;
    }
}
