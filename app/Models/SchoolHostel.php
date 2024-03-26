<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolHostel extends Model
{
    use HasFactory;
    protected $guarded = [];

   

        public function room()
        {
           return $this->belongsTo(HostelRoom::class, 'hostel_room_id');
        }


        public function category()
        {
           return $this->belongsTo(HostelCategory::class, 'hostel_category_id');
        }
}
