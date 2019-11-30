<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   protected $fillable = [
        'name', 'email', 'salary','address','phone','photo','nid','joining_date',
    ];
}
