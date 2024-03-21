<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $guarded = [];

     // Define enum options for status column
     public const STATUS_PAID = 'paid';
     public const STATUS_UNPAID = 'unpaid';

     public function users()
     {
        return $this->belongsTo(User::class, 'user_id');
     }


     public function department()
     {
        return $this->belongsTo(Department::class, 'department_id');
     }


     public function designation()
     {
        return $this->belongsTo(Designation::class, 'department_id');
     }





     


}
