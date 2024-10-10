<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "sender_id",
    ];


     //An organisaton has many departments
     public function departments()
     {
         return $this->hasMany(Department::class);
     }
 
     
     public function users()
     {
         return $this->hasMany(User::class);
     }
 
 
     public function group()
     {
         return $this->hasMany(Group::class);
     }
 
     public function contactJobs()
     {
         return $this->hasMany(ContactJob::class);
     }
}
