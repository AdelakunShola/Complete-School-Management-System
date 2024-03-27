<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function designations()
    {
        return $this->hasMany(Designation::class);
    }

    

    public function users()
    {
        return $this->hasMany(User::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'hod', 'id');
    }

    
    public function teachers()
    {
        return $this->hasMany(User::class)->where('role', 'teacher');
    }



}
