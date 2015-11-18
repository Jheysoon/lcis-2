<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table    = 'tbl_registration';
    public $timestamps  = false;

    public function user()
    {
        return $this->belongsTo('App\Party', 'student');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('academicterm', 'DESC');
    }

    public function scopeStudent($query, $student)
    {
        return $query->where('student', $student);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'P');
    }
}
