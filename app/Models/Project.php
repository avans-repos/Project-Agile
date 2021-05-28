<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;

  protected $table = 'projects';
  protected $fillable = ['name', 'description', 'deadline', 'notes'];

  public function projectgroups() {
    return $this->hasMany(Projectgroup::class, 'project');
  }
}
