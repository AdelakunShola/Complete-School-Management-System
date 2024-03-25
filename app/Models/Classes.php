<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users()
{
    return $this->belongsTo(User::class, 'teacher_id');
}

public function sections()
{
    return $this->hasMany(Section::class, 'class_id');
}


}
