<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSubject extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }


    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'subjects_id', 'id');
    }


}



