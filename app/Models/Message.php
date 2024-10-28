<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ReportStatus;
use App\Models\{Contact,User,Group,Department};

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        "message_content",
        "sender_id",
        "department_id",
        "group_id",
        // "user_id"
        // "scheduled_at",
    ];


       // One MessageJob belongs to a User
       public function user()
       {
           return $this->belongsTo(User::class);
       }

       public function contact()
       {
           return $this->belongsTo(Contact::class);
       }


       public function department()
       {
        return $this->belongsTo(Department::class);
       }
       

       public function group()
       {
           return $this->belongsTo(Group::class);
       }

 
}