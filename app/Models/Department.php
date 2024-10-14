<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "organisation_id",
    ] ;

    //A department belongs to one organisation
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    //A department has many users
    public function users()


    {
        return $this->hasMany(User::class);
    }

    //A department has many groups
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    //One department has many templates
    public function templates()
    {
        return $this->hasMany(Template::class);
    }
}
