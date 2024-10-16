<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "template_message",
        "user_id",
    ];

    // One Template belongs to a Department
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}