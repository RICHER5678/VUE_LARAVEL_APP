<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "organisation_id",
        "department_id",
        ];
  
      // One Group belongs to a Department
      public function department()
      {
          return $this->belongsTo(Department::class);
      }

      // One Group has many contacts
      public function contacts()
      {
          return $this->hasMany(Contact::class);
      }

      public function organisation()
      {
          return $this->belongsTo(Organisation::class);
      }

}
