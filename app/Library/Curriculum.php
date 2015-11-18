<?php

namespace App\Library;

use DB;

class Curriculum
{
    public static function getCurrentCurriculum($course, $major, $system)
    {
        $coursemajor = DB::table('tbl_coursemajor')
                    ->where('course', $course)
                    ->where('major', $major)->first();

        $academics  = DB::table('tbl_academicterm')->where('systart', '<=', $system->currentacademiterm)
                    ->orderBy('systart', 'DESC')->orderBy('term')->get();

        foreach ($academics as $academic) {
            $cur    = DB::table('tbl_curriculum')->where('coursemajor', $coursemajor)
                    ->where('academicterm', $academic->id);

            if ($cur->count() > 0) {
                $c = $cur->first();

                // return the latest curriculum
                return $c->id;
            }
        }
        // TODO: add a fallback method here !!!
    }
}
